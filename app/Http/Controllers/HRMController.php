<?php

namespace App\Http\Controllers;

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
}