<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
            abort(403);
        }

        $user = auth()->user();

        if (!$user->role || $user->role->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
