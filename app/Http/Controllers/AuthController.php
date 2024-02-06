<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return redirect()->intended('/dashboard'); // Ganti dengan rute yang sesuai

            } else {
                return redirect()->intended('/nilai-triwulan'); // Ganti dengan rute yang sesuai

            }
        }

        return back()->with('errorLogin', 'Email or password invalid !');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login'); // Change it to the appropriate route after logout
    }
}
