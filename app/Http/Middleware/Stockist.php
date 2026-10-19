<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use RealRashid\SweetAlert\Facades\Alert;

class Stockist
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

        $allowedRoles = ['pemilik', 'stockist', 'admin', 'admintkb', 'produksi'];
        if (in_array(strtolower(auth()->user()->role), $allowedRoles)) {
            return $next($request);
        }

        Alert::error('Kamu tidak memiliki akses');
        return redirect('/profile');
    }
}
