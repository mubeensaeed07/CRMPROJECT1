<?php

namespace Modules\HRM\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HRMController extends Controller
{
    public function dashboard()
    {
        // Calculate total salary for users under this admin/supervisor
        $currentUser = Auth::user();
        $totalSalary = 0;
        
        if ($currentUser->isAdmin() || $currentUser->isSuperAdmin()) {
            // For admins, get all users
            $totalSalary = User::whereNotNull('salary')->sum('salary');
        } elseif ($currentUser->isSupervisor()) {
            // For supervisors, get users they manage (if any relationship exists)
            $totalSalary = User::where('supervisor_id', $currentUser->id)->whereNotNull('salary')->sum('salary');
        }
        
        return view('hrm::dashboard', compact('totalSalary'));
    }

    public function employees()
    {
        return view('hrm::employees.index');
    }

    public function departments()
    {
        return view('hrm::departments.index');
    }

    public function attendance()
    {
        return view('hrm::attendance.index');
    }

    public function payroll()
    {
        return view('hrm::payroll.index');
    }

    public function createUser()
    {
        return view('hrm::users.create');
    }

    public function storeUser(Request $request)
    {
        $currentUser = Auth::user();
        
        // Ensure we have valid created_by values
        if (!$currentUser || !$currentUser->id) {
            return redirect()->back()->with('error', 'Invalid user session. Please login again.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'salary' => 'nullable|numeric|min:0',
            'role' => 'required|string',
        ]);
        
        // Get the SuperAdmin ID for all users
        $superAdmin = User::where('role_id', 1)->first();
        $superAdminId = $superAdmin ? $superAdmin->id : 1; // Default to 1 if no SuperAdmin found
        
        // Determine created_by values
        $createdByType = $currentUser->isSupervisor() ? 'supervisor' : 'admin';
        $createdById = $currentUser->id;
        
        // Validate created_by values are not null
        if (empty($createdByType) || empty($createdById)) {
            return redirect()->back()->with('error', 'Unable to determine user creator. Please try again.');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => bcrypt('password123'), // Default password
            'salary' => $request->salary,
            'role_id' => 3, // User role (ID 3)
            'is_approved' => true,
            'admin_id' => $currentUser->isSupervisor() ? $currentUser->admin_id : $currentUser->id,
            'superadmin_id' => $superAdminId, // Always set superadmin_id
            'created_by_type' => $createdByType,
            'created_by_id' => $createdById,
        ]);

        // Verify the user was created with proper created_by values
        if (empty($user->created_by_type) || empty($user->created_by_id)) {
            \Log::error('User created with NULL created_by values', [
                'user_id' => $user->id,
                'created_by_type' => $user->created_by_type,
                'created_by_id' => $user->created_by_id
            ]);
            return redirect()->back()->with('error', 'User created but tracking information is missing. Please contact administrator.');
        }

        return redirect()->route('hrm.users.index')->with('success', 'User created successfully!');
    }

    public function users()
    {
        $currentUser = Auth::user();
        
        // Get users based on current user's role
        if ($currentUser->isAdmin() || $currentUser->isSuperAdmin()) {
            // Admin sees users created by them or by their supervisors
            $users = User::where('admin_id', $currentUser->id)
                        ->orWhere(function($query) use ($currentUser) {
                            $query->where('created_by_type', 'supervisor')
                                  ->where('created_by_id', $currentUser->id);
                        })
                        ->get();
        } elseif ($currentUser->isSupervisor()) {
            // Supervisor sees users they created
            $users = User::where('created_by_type', 'supervisor')
                        ->where('created_by_id', $currentUser->id)
                        ->get();
        } else {
            $users = collect();
        }
        
        // Calculate statistics
        $totalUsers = $users->count();
        $activeUsers = $users->where('is_approved', true)->count();
        $inactiveUsers = $users->where('is_approved', false)->count();
        $departments = $users->pluck('department')->unique()->count();
        
        return view('hrm::users.index', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers', 'departments'));
    }
}
