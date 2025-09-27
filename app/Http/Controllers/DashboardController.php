<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if supervisor is logged in
        if (Auth::guard('supervisor')->check()) {
            return redirect()->route('supervisor.dashboard');
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if (!$user->is_approved) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending approval.');
        }

        // Redirect based on user role
        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }
}
