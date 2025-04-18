<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpFoundation\Response;

class CatchPostTooLargeException
{
    public function handle($request, Closure $next)
    {
        try {
            return $next($request);
        } catch (PostTooLargeException $e) {
            return redirect()->route('dashboard')->with('error', 'File too large. Max allowed size is 10MB.');
        }
    }
}
