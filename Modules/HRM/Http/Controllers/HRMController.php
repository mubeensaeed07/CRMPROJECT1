<?php

namespace Modules\HRM\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HRMController extends Controller
{
    public function dashboard()
    {
        return view('hrm.dashboard');
    }

    public function employees()
    {
        return view('hrm.employees.index');
    }

    public function departments()
    {
        return view('hrm.departments.index');
    }

    public function attendance()
    {
        return view('hrm.attendance.index');
    }

    public function payroll()
    {
        return view('hrm.payroll.index');
    }

    public function createUser()
    {
        return view('hrm.users.create');
    }

    public function storeUser(Request $request)
    {
        // User creation logic will be implemented here
        return redirect()->route('hrm.users.index')->with('success', 'User created successfully!');
    }

    public function users()
    {
        return view('hrm.users.index');
    }
}
