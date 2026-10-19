<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;


class Karyawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $allowedRoles = ['pemilik', 'admin', 'admintkb', 'produksi', 'stockist', 'magang'];
        if (in_array(strtolower(auth()->user()->role), $allowedRoles)) {
            return $next($request);
        }
        Alert::error('Kamu tidak memiliki akses Karyawan');
        return redirect('/profile');
    }
}
