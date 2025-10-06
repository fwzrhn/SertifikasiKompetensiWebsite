<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Cek prefix URL
            if ($request->is('operator/*') || $request->is('operator')) {
                return redirect()->route('operator.login');
            } elseif ($request->is('administrator/*') || $request->is('administrator')) {
                return redirect()->route('admin.login');
            }

            // Default fallback
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
