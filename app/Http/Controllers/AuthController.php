<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function prosesLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed

            $role = auth()->user()->role;

            if ($role == 'Admin') {
                return redirect()->intended('/dashboard');
            } elseif ($role == 'Sekretaris') {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/nilai-triwulan');
            }
        } else {
            Alert::toast('Login Gagal', 'error');
            return back()->withErrors([
                'username' => 'Username salah atau belum terdaftar, silahkan periksa kembali.',
                'password' => 'Password salah, silahkan periksa kembali.'
            ]);
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/login'); // Change it to the appropriate route after logout
    }
}
