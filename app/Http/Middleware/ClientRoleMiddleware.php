<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if the user has a client role or is associated with a client
        // For now, we'll check if the user is linked to a client entity
        $user = Auth::user();
        
        // In a real application, you might check for specific client roles or permissions
        // For basic implementation, we'll check if the user is linked to any client
        // by checking if they have any client-related associations
        $hasClientAccess = $this->userHasClientAccess($user);
        
        if (!$hasClientAccess) {
            abort(403, 'Unauthorized access to client portal');
        }

        return $next($request);
    }
    
    /**
     * Check if user has access to client portal
     */
    private function userHasClientAccess($user)
    {
        // For now, we'll check if the user is directly associated with a client
        // In a real application, this might involve checking roles, permissions,
        // or client-user relationships
        
        // Check if user has any role that allows client access
        // This assumes you might have a role-based system
        if ($user->hasRole('client') || $user->hasRole('customer')) {
            return true;
        }
        
        // Check if user is associated with any clients through a pivot table
        // This assumes a relationship like: users -> user_clients -> clients
        if ($user->clients && $user->clients->count() > 0) {
            return true;
        }
        
        // If user is assigned to tasks for clients or projects for clients
        if ($user->projects && $user->projects->pluck('client_id')->filter()->count() > 0) {
            return true;
        }
        
        return false;
    }
}