<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is logged in
        if (!auth()->check()) {
            abort(403, 'Unauthorized.'); // User not logged in
        }

        $user = auth()->user();

        // Check if user has a role and if it matches any of the allowed roles
        if (!$user->role || !in_array($user->role->role, $roles)) {
            abort(403, 'Unauthorized.'); // User role not allowed
        }

        return $next($request);
    }
}
