<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;

class AdminSignUpController extends Controller
{
    public function show()
    {
        return view('auth.signup_admin');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'repeat_password' => 'required|same:password',
            'name' => 'required'
        ]);

        // Insert ke database
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => 'A',
            'address' => '-',
            'phone_number' => '-',
            'status_del' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::login($user);

        // Pastikan session disimpan sebelum redirect
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('success', 'Admin successfully created.');
    }
}
