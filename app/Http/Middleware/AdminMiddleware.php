<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek jika user login dan role-nya admin
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request); // Izinkan akses
        }

        // Jika bukan admin, arahkan ke halaman lain (misalnya home)
        return redirect('/home')->with('error', 'You do not have admin access.');
    }
}
