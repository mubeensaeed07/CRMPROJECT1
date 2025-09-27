<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventBackButton
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
        // Check if user is authenticated with either web or supervisor guard
        if (!Auth::check() && !Auth::guard('supervisor')->check()) {
            return redirect()->route('login');
        }
        
        $response = $next($request);
        
        // Add cache control headers to prevent back button access
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
        $response->headers->set('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        
        return $response;
    }
}