<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use RealRashid\SweetAlert\Facades\Alert;

class Magang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $allowedRoles = ['magang', 'admin', 'admintkb', 'pemilik', 'stockist', 'produksi'];

        if (in_array(strtolower(Auth::user()->role), $allowedRoles)) {
            return $next($request);
        }

        Alert::error('Kamu tidak memiliki akses');
        return redirect('/profile');
    }
}