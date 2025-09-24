<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if (!$user->is_approved) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Your account is pending approval.');
        }

        if (!$user->isAdmin() && !$user->isSuperAdmin()) {
            return redirect()->route('user.dashboard')->with('error', 'You do not have admin access.');
        }

        return $next($request);
    }
}
