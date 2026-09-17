<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless(
            Auth::user()?->role === 'admin',
            403,
            'You do not have access to this page.'
        );

        return $next($request);
    }
}