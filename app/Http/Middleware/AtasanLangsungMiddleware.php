<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtasanLangsungMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Mendapatkan pengguna yang sedang masuk
        $user = Auth::user();

        // Memeriksa apakah pengguna memiliki peran 'Atasan Langsung' atau 'Kepegawai'
        if ($user && ($user->role === 'Atasan Langsung' || $user->role === 'Kepegawaian')) {
            // Jika memiliki peran tersebut, kembalikan pengguna ke rute yang sesuai
            return redirect('nilai-triwulan');
        }

        // Jika pengguna tidak memiliki peran tersebut, lanjutkan permintaan
        return $next($request);
    }
}
