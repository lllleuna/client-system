<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionExpiredMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !$request->session()->has('_token')) {
            Auth::logout();
            return response()->json(['session_expired' => true], 419);
        }

        return $next($request);
    }
}

