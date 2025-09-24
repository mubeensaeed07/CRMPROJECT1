<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use App\Models\UserModule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Redirect SuperAdmins and Admins to their appropriate dashboards
        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        $userModules = UserModule::where('user_id', $user->id)
            ->with('module')
            ->get();
        
        return view('user.dashboard', compact('userModules'));
    }

    public function showModule($moduleId)
    {
        $user = Auth::user();
        $userModule = UserModule::where('user_id', $user->id)
            ->where('module_id', $moduleId)
            ->with('module')
            ->first();
        
        if (!$userModule) {
            return redirect()->route('user.dashboard')->with('error', 'You do not have access to this module.');
        }
        
        return view('user.module', compact('userModule'));
    }

    public function getMyModules()
    {
        $user = Auth::user();
        $userModules = UserModule::where('user_id', $user->id)
            ->with('module')
            ->get();
        
        return response()->json($userModules);
    }

    public function profile()
    {
        $user = Auth::user();
        $user->load('userInfo');
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'website_url' => 'nullable|url|max:255',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:50',
            'timezone' => 'nullable|string|max:50',
            'language' => 'nullable|string|max:10',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['avatar', 'email_notifications', 'sms_notifications']);
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $user->id . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/avatars', $avatarName);
            $data['avatar'] = 'avatars/' . $avatarName;
        }
        
        // Handle boolean fields
        $data['email_notifications'] = $request->has('email_notifications');
        $data['sms_notifications'] = $request->has('sms_notifications');
        
        // Update name field for compatibility
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];

        // Update user basic info
        $user->update([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email']
        ]);

        // Update or create user info
        $userInfo = $user->userInfo;
        if (!$userInfo) {
            $userInfo = $user->userInfo()->create($data);
        } else {
            $userInfo->update($data);
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
