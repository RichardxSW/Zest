<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        $user = Auth::user();
        
        if (!Auth::check()) {
            return redirect('/home');
        }

        if ($user->role === 'Super_Admin') {
            return $next($request);
        }

        if (!in_array($user->role, $role)) {
            return redirect('/home');
        }

        return $next($request);
    }
}
