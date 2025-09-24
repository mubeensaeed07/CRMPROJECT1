<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    // Google OAuth for Sign Up
    public function redirectToGoogleSignup()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleSignupCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            \Log::info('Google OAuth Sign Up successful', [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'id' => $googleUser->id
            ]);
            
            $user = User::where('email', $googleUser->email)->first();
            
            if ($user) {
                // User already exists - redirect to sign in
                return redirect()->route('login')->with('error', 'Account already exists. Please sign in instead.');
            } else {
                // New user - create account and require SuperAdmin approval
                $user = User::create([
                    'first_name' => $googleUser->user['given_name'] ?? '',
                    'last_name' => $googleUser->user['family_name'] ?? '',
                    'name' => $googleUser->name ?? '',
                    'email' => $googleUser->email,
                    'role_id' => 2, // Admin role for new registrations
                    'is_approved' => false,
                    'password' => Hash::make('google_oauth_user')
                ]);
                
                // Get the SuperAdmin ID (role_id = 1)
                $superAdmin = User::where('role_id', 1)->first();
                $superAdminId = $superAdmin ? $superAdmin->id : null;
                
                // Create user info with hierarchy
                $user->userInfo()->create([
                    'admin_id' => null, // New admin, no admin above them
                    'superadmin_id' => $superAdminId
                ]);
                
                // Create user identification record
                DB::table('user_identification')->insert([
                    'user_id' => $user->id,
                    'admin_id' => null,
                    'superadmin_id' => $superAdminId,
                    'user_role' => 'admin',
                    'status' => 'pending',
                    'approved_at' => null,
                    'assigned_at' => now(),
                    'notes' => 'Created via Google OAuth Sign Up',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                \Log::info('New user created via Google OAuth Sign Up', ['user_id' => $user->id, 'superadmin_id' => $superAdminId]);
                
                return redirect()->route('register')->with('success', 'Account created successfully! Please wait for SuperAdmin approval.');
            }
        } catch (\Exception $e) {
            \Log::error('Google OAuth Sign Up failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('register')->with('error', 'Google sign up failed: ' . $e->getMessage());
        }
    }

    // Google OAuth for Sign In
    public function redirectToGoogleSignin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleSigninCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            \Log::info('Google OAuth Sign In successful', [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'id' => $googleUser->id
            ]);
            
            $user = User::where('email', $googleUser->email)->first();
            
            \Log::info('User lookup result', [
                'email' => $googleUser->email,
                'user_exists' => $user ? 'Yes' : 'No',
                'user_id' => $user ? $user->id : null
            ]);
            
            if ($user) {
                // User exists, check if they need to complete profile
                // Only redirect to profile setup if they haven't set a proper password yet
                if ($user->password === 'google_oauth_user') {
                    return redirect()->route('profile.setup')->with('user', $user);
                }
                
                if (!$user->is_approved) {
                    return redirect()->route('login')->with('error', 'Your account is pending approval.');
                }
                
                Auth::login($user);
                return redirect()->intended('/');
            } else {
                // User doesn't exist - redirect to sign up
                return redirect()->route('register')->with('info', 'No account found with this email address. Please sign up first.');
            }
        } catch (\Exception $e) {
            \Log::error('Google OAuth Sign In failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')->with('error', 'Google sign in failed: ' . $e->getMessage());
        }
    }

    public function showProfileSetup()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login');
        }
        
        return view('auth.profile-setup', compact('user'));
    }

    public function completeProfile(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login');
        }

        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'password' => Hash::make($request->password)
        ]);

        session()->forget('user');
        
        return redirect()->route('login')->with('success', 'Profile completed! Please wait for admin approval.');
    }
}
