<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutoAdminGate
{
    public function handle($request, Closure $next)
    {
        if ($request->is('admin/*')) {
            if (!Auth::check() || Auth::user()->role !== 'admin') {
                abort(403, 'Akses hanya untuk admin.');
            }
        }

        return $next($request);
    }
}
