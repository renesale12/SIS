<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/'); // Redirect to home if not logged in
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized action.'); // 403 error if role does not match
        }

        return $next($request);
    }
}
