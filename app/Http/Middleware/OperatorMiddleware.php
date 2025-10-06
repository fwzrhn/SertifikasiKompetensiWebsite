<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OperatorMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login dan role-nya operator
        if (Auth::check() && Auth::user()->role === 'operator') {
            return $next($request);
        }

        // Kalau bukan operator, tolak akses
        return redirect('/')->with('error', 'Akses dibatasi untuk operator.');
    }
}
