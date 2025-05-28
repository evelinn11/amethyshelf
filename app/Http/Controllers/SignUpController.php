<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    //
    public function show()
    {
        return view('auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
            'repeat_password' => 'required',
            'name' => 'required'
        ]);

        if ($request->password !== $request->repeat_password) {
            return back()->withErrors([
                'repeat_password' => 'Password dan Repeat Password tidak sama.'
            ])->withInput();
    }

        // Ambil daftar user signup dari session, jika belum ada buat array kosong
        $users = $request->session()->get('signup_users', []);

        $users[] = [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'role' => 'user'
        ];

        // Simpan ke session
        $request->session()->put('signup_users', $users);

        // Login user baru
        $request->session()->put('user', [
            'email' => $request->email,
            'name' => $request->name,
            'role' => 'user'
        ]);

        return redirect()->route('home.show');
    }
}
