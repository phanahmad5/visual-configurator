<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'admin'.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus untuk Admin.');
        }

        return $next($request);
    }
}
