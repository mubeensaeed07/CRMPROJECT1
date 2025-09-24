<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

/**
 * AdminUserOwnershipMiddleware - Ensures admins can only access their own users
 * 
 * This middleware prevents admins from accessing users that don't belong to them.
 * It checks if the user being accessed belongs to the current admin.
 */
class AdminUserOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     * Checks if the admin is trying to access a user that belongs to them
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the user ID from the route
        $userId = $request->route('id');
        
        if ($userId) {
            // Check if the user exists and belongs to the current admin
            $user = User::where('id', $userId)
                       ->where('admin_id', auth()->id())
                       ->first();
            
            if (!$user) {
                abort(403, 'You can only access users that belong to you.');
            }
        }

        return $next($request);
    }
}