<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Memeriksa apakah peran pengguna sesuai dengan salah satu dari peran yang diizinkan
        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request);
            }
        }

        // Jika peran pengguna tidak sesuai dengan peran yang diizinkan, maka tampilkan pesan error
        abort(403, 'Ketahui Batasanmu');
    }
}
