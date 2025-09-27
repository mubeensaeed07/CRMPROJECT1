<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supervisor;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;

class SupervisorAuthController extends Controller
{
    public function dashboard()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $modules = $supervisor->modules;
        
        // Get statistics
        $totalModules = $modules->count();
        $activeModules = $modules->where('is_active', true)->count();
        
        return view('supervisor.dashboard', compact('supervisor', 'modules', 'totalModules', 'activeModules'));
    }

    public function profile()
    {
        $supervisor = Auth::guard('supervisor')->user();
        return view('supervisor.profile', compact('supervisor'));
    }

    public function module($moduleId)
    {
        $supervisor = Auth::guard('supervisor')->user();
        $module = Module::findOrFail($moduleId);
        
        // Check if supervisor has access to this module
        $supervisorModule = $supervisor->modules()->where('module_id', $moduleId)->first();
        
        if (!$supervisorModule) {
            return redirect()->route('supervisor.dashboard')->with('error', 'You do not have access to this module.');
        }
        
        // Get module permissions
        $permissions = [
            'can_create_users' => $supervisorModule->pivot->can_create_users,
            'can_edit_users' => $supervisorModule->pivot->can_edit_users,
            'can_delete_users' => $supervisorModule->pivot->can_delete_users,
            'can_reset_passwords' => $supervisorModule->pivot->can_reset_passwords,
            'can_assign_modules' => $supervisorModule->pivot->can_assign_modules,
            'can_view_reports' => $supervisorModule->pivot->can_view_reports,
        ];
        
        // Route to appropriate module controller based on module name
        switch (strtolower($module->name)) {
            case 'hrm':
            case 'human resource management':
                return redirect()->route('hrm.dashboard');
            case 'crm':
            case 'customer relationship management':
                return redirect()->route('crm.dashboard');
            case 'inventory':
                return redirect()->route('inventory.dashboard');
            case 'finance':
                return redirect()->route('finance.dashboard');
            default:
                // Generic module view
                return view('supervisor.module', compact('module', 'permissions', 'supervisor'));
        }
    }

    public function updateProfile(Request $request)
    {
        $supervisor = Auth::guard('supervisor')->user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:supervisors,email,' . $supervisor->id,
        ]);

        $supervisor->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function logout()
    {
        Auth::guard('supervisor')->logout();
        session()->forget(['user_type', 'supervisor_id']);
        
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
