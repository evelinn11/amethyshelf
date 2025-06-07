<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user login
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Forbidden');
        }
        // Cek apakah user punya salah satu role yang diizinkan (langsung dari field role di myuser)
        if (!in_array($user->role, $roles)) {
            abort(403, 'Forbidden');
        }
        return $next($request);
    }
}
