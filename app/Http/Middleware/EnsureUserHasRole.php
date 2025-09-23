<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if ($role === null) {
            return $next($request);
        }

        if (! $user->hasRole($role)) {
            abort(403);
        }

        return $next($request);
    }
}
