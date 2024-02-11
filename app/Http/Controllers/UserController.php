<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6|',
            'role' => 'required'

        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
        ]);
        $validate['password'] = Hash::make($request->password);

        // dd($validate);

        try {
            User::create($validate);
            Alert::success('Berhasil', 'Data berhasil ditambahkan');
            return redirect('/users');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal ditambahkan');
            return redirect('/users');
        }
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ], [
            'name.required' => 'Kolom nama wajib diisi',
            'username.unique' => 'Username sudah digunakan',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        // Menghapus password dari validasi jika tidak ada password yang diinput
        if (!$request->filled('password')) {
            unset($validate['password']);
        } else {
            $validate['password'] = Hash::make($request->password);
        }

        try {
            $user = User::findOrFail($id);
            $user->update($validate);
            Alert::success('Berhasil', 'Data berhasil diperbarui');
            return redirect('/users');
        } catch (\Throwable $e) {
            Alert::error('Gagal', 'Data gagal diperbarui');
            return redirect('/users');
        }
    }

    public function destroy($id)
    {
        try {
            $users = User::findOrFail($id);
            $users->delete();
            return redirect('/users');
        } catch (\Exception $e) {
            Alert::toast('Berhasil mengahapus data',);
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
