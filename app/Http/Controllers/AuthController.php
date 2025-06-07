<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    //
    public function show()
    {
        return view('auth.signin');
    }

    public function signin_auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'A') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home.show');
        }

        return back()->withErrors([
            'email' => 'Email or password inccorect.',
        ])->withInput();
    }

    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin.show');
    }
}
