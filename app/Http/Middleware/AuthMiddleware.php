<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        switch ($role) {
            case 'mahasiswa':
                if ($user->hasRole('mahasiswa')) {
                    return $next($request);
                }
                return redirect()->route('dashboardMahasiswa');
                break;
            case 'dosen':
                if ($user->hasRole('dosen')) {
                    return $next($request);
                }
                return redirect()->route('dashboardDosen');
                break;
            case 'koor':
                if ($user->hasRole('koor')) {
                    return $next($request);
                }
                return redirect()->route('dashboardKoor');
                break;
            case 'admin':
                if ($user->hasRole('admin')) {
                    return $next($request);
                }
                return redirect()->route('dashboardAdmin');
                break;
            default:
                return redirect()->route('login');
        }
    }
}
