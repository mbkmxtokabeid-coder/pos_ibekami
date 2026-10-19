<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (strtolower(Auth::user()->role) !== strtolower($role)) {
            Alert::error('Akses Ditolak', 'Hanya role ' . ucfirst($role) . ' yang dapat mengakses halaman ini.');
            return redirect('/profile');
        }

        return $next($request);
    }
}
