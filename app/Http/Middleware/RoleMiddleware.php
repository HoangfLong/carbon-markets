<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Ensure the user is authenticated
        $user = $request->user();
        
        // If the user is a guest (not authenticated)
        if (!$user) {
            // Allow access to public routes (guest)
            return $next($request);
        }

        // If the user is authenticated, check their role
        if (!in_array($user->role, $roles)) {
            return abort(404);
        }

        return $next($request); // Continue processing the request
    }
}
