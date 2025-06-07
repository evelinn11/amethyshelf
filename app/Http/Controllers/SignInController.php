<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    //
    public function show()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->role === 'A') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('home.show');
        }
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }
}
