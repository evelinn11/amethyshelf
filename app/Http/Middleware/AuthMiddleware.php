<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role =null): Response
        {
        $user = session('user');
        if (!$user) {
            return redirect()->route('signin.show');
        }
        // Jika role dicek dan tidak sesuai, abort 403
        if ($role && $user['role'] !== $role) {
            abort(403, 'Forbidden');
        }
        return $next($request);
    }
}
