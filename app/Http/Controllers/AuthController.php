<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\RecaptchaService;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.signin-cover');
    }

    public function login(Request $request)
    {
        // Debug: Log login attempt
        \Log::info('Login attempt', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            \Log::info('Validation failed', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Verify reCAPTCHA
        $recaptchaService = new RecaptchaService();
        if (!$recaptchaService->verify($request->input('g-recaptcha-response'), $request->ip())) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
        }

        $credentials = $request->only('email', 'password');
        
        // Try to authenticate as a regular user first
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            
            if (!$user->is_approved) {
                Auth::guard('web')->logout();
                return redirect()->back()->with('error', 'Your account is pending approval.');
            }

            return redirect()->intended('/');
        }

        // Try to authenticate as a supervisor
        if (Auth::guard('supervisor')->attempt($credentials)) {
            $supervisor = Auth::guard('supervisor')->user();
            
            if (!$supervisor->isActive()) {
                Auth::guard('supervisor')->logout();
                return redirect()->back()->with('error', 'Your supervisor account is inactive.');
            }

            // Store supervisor info in session for dashboard access
            session(['user_type' => 'supervisor', 'supervisor_id' => $supervisor->id]);
            
            // Debug: Log successful authentication
            \Log::info('Supervisor authentication successful', [
                'supervisor_id' => $supervisor->id,
                'email' => $supervisor->email,
                'session_data' => session()->all()
            ]);
            
            return redirect()->route('supervisor.dashboard');
        }

        // Debug: Log authentication failure
        \Log::info('Authentication failed', [
            'email' => $request->email,
            'user_exists' => User::where('email', $request->email)->exists(),
            'supervisor_exists' => Supervisor::where('email', $request->email)->exists()
        ]);

        // Check if user exists but password is wrong
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()->back()->with('error', 'Invalid password.');
        }

        // Check if supervisor exists but password is wrong
        $supervisor = Supervisor::where('email', $request->email)->first();
        if ($supervisor) {
            return redirect()->back()->with('error', 'Invalid password.');
        }

        // User doesn't exist - redirect to signup
        return redirect()->route('register')->with('info', 'No account found with this email. Please sign up first.');
    }

    public function showRegister()
    {
        return view('pages.signup-cover');
    }

    public function register(Request $request)
    {
        \Log::info('Registration attempt', $request->all());
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            \Log::info('Validation failed', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validate reCAPTCHA
        $recaptchaService = new RecaptchaService();
        if (!$recaptchaService->verify($request->input('g-recaptcha-response'), $request->ip())) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name, // For compatibility
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Admin role for new registrations
            'is_approved' => false
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
            'notes' => 'Created via registration form',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \Log::info('User created successfully', ['user_id' => $user->id, 'superadmin_id' => $superAdminId]);
        
        return redirect()->route('login')->with('success', 'Registration successful! Please wait for SuperAdmin approval.');
    }

    public function logout()
    {
        Auth::logout();
        
        // Clear all session data
        session()->flush();
        
        // Clear all cookies
        cookie()->forget('laravel_session');
        cookie()->forget('XSRF-TOKEN');
        
        // Redirect to login with aggressive cache control headers
        return redirect()->route('login')
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
                'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT',
                'Clear-Site-Data' => '"cache", "cookies", "storage", "executionContexts"'
            ]);
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
