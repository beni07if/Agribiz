<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {
        // Asumsi ada kolom 'role' di tabel users
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized'); // atau redirect ke home
    }
}