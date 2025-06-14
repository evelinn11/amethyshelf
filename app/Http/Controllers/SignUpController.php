<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'repeat_password' => 'required|same:password',
            'name' => 'required'
        ]);

        // Insert ke database
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => 'U',
            'address' => '-',
            'phone_number' => '-',
            'status_del' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Login user baru (opsional, jika ingin langsung login)
        Auth::login($user);

        // Redirect sesuai role
        if ($user->role === 'A') {
            return redirect()->route('dashboard');
        }
        else if ($user->role === 'U') {
            return redirect()->route('home.show');
        }
    }
}
