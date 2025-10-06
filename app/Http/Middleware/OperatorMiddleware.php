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
        // Jika belum login → arahkan ke login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika sudah login tapi bukan operator
        if (Auth::user()->role !== 'operator') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses hanya untuk operator.');
        }

        // Jika role sesuai → lanjut
        return $next($request);
    }
}
