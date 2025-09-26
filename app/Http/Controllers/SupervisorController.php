<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\SupervisorPermission;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail;

class SupervisorController extends Controller
{
    public function index()
    {
        // Only show supervisors that belong to the current admin
        $supervisors = Supervisor::where('admin_id', auth()->id())
                                ->with(['permissions.module', 'admin'])
                                ->get();
        $modules = Module::all();
        
        return view('admin.supervisors.index', compact('supervisors', 'modules'));
    }

    public function create()
    {
        $modules = Module::all();
        return view('admin.supervisors.create', compact('modules'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:supervisors,email',
            'modules' => 'required|array|min:1',
            'modules.*' => 'exists:modules,id',
            'permissions' => 'required|array',
            'permissions.*' => 'array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate a random password
        $password = $this->generateRandomPassword();
        
        // Get the SuperAdmin ID from the current admin's user_info
        $currentAdmin = auth()->user();
        $currentAdminInfo = $currentAdmin->userInfo;
        $superAdminId = $currentAdminInfo ? $currentAdminInfo->superadmin_id : null;
        
        $supervisor = Supervisor::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'admin_id' => auth()->id(),
            'superadmin_id' => $superAdminId
        ]);

        // Create permissions for each module
        foreach ($request->modules as $moduleId) {
            $permissions = $request->permissions[$moduleId] ?? [];
            
            SupervisorPermission::create([
                'supervisor_id' => $supervisor->id,
                'module_id' => $moduleId,
                'can_create_users' => in_array('create_users', $permissions),
                'can_edit_users' => in_array('edit_users', $permissions),
                'can_delete_users' => in_array('delete_users', $permissions),
                'can_reset_passwords' => in_array('reset_passwords', $permissions),
                'can_assign_modules' => in_array('assign_modules', $permissions),
                'can_view_reports' => in_array('view_reports', $permissions)
            ]);
        }

        // Send email notification to the new supervisor
        try {
            Mail::to($supervisor->email)->send(new UserRegisteredMail($supervisor, $password, auth()->user()->full_name));
        } catch (\Exception $e) {
            \Log::error('Failed to send supervisor registration email: ' . $e->getMessage());
        }

        return redirect()->route('admin.supervisors.index')->with('success', 'Supervisor created successfully! An email with login credentials has been sent.');
    }

    public function show($id)
    {
        $supervisor = Supervisor::where('id', $id)
                               ->where('admin_id', auth()->id())
                               ->with(['permissions.module', 'admin'])
                               ->firstOrFail();
        
        return view('admin.supervisors.show', compact('supervisor'));
    }

    public function edit($id)
    {
        $supervisor = Supervisor::where('id', $id)
                               ->where('admin_id', auth()->id())
                               ->with(['permissions.module'])
                               ->firstOrFail();
        $modules = Module::all();
        
        return view('admin.supervisors.edit', compact('supervisor', 'modules'));
    }

    public function update(Request $request, $id)
    {
        $supervisor = Supervisor::where('id', $id)
                               ->where('admin_id', auth()->id())
                               ->firstOrFail();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:supervisors,email,' . $id,
            'status' => 'required|in:active,inactive',
            'modules' => 'required|array|min:1',
            'modules.*' => 'exists:modules,id',
            'permissions' => 'required|array',
            'permissions.*' => 'array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'status' => $request->status
        ]);

        // Update permissions
        SupervisorPermission::where('supervisor_id', $supervisor->id)->delete();
        
        foreach ($request->modules as $moduleId) {
            $permissions = $request->permissions[$moduleId] ?? [];
            
            SupervisorPermission::create([
                'supervisor_id' => $supervisor->id,
                'module_id' => $moduleId,
                'can_create_users' => in_array('create_users', $permissions),
                'can_edit_users' => in_array('edit_users', $permissions),
                'can_delete_users' => in_array('delete_users', $permissions),
                'can_reset_passwords' => in_array('reset_passwords', $permissions),
                'can_assign_modules' => in_array('assign_modules', $permissions),
                'can_view_reports' => in_array('view_reports', $permissions)
            ]);
        }

        return redirect()->route('admin.supervisors.index')->with('success', 'Supervisor updated successfully!');
    }

    public function destroy($id)
    {
        $supervisor = Supervisor::where('id', $id)
                               ->where('admin_id', auth()->id())
                               ->firstOrFail();
        
        $supervisor->delete();

        return redirect()->back()->with('success', 'Supervisor deleted successfully!');
    }

    public function resetPassword($id)
    {
        $supervisor = Supervisor::where('id', $id)
                               ->where('admin_id', auth()->id())
                               ->firstOrFail();
        
        $newPassword = $this->generateRandomPassword();
        
        $supervisor->update([
            'password' => Hash::make($newPassword)
        ]);

        // Send email notification
        try {
            Mail::to($supervisor->email)->send(new UserRegisteredMail($supervisor, $newPassword, auth()->user()->full_name));
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Password reset but failed to send email notification.');
        }

        return redirect()->back()->with('success', 'Password reset successfully! An email with new credentials has been sent.');
    }

    private function generateRandomPassword($length = 12)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $password;
    }
}