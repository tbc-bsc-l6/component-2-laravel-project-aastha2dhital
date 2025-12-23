<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->role || auth()->user()->role->name !== $role) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
