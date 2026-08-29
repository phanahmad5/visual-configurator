<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     * Hanya mengizinkan user dengan role 'user' (bukan admin).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'user') {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Akses ditolak. Halaman ini khusus untuk Pengguna.');
        }

        return $next($request);
    }
}
