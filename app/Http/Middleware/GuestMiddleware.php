<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard'); // kalau belum login, redirect ke login
        }

        return $next($request);
    }
}