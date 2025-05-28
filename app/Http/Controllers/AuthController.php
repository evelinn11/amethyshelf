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
        // $credentials = request()->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required',
        // ]);
        
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/home');
        // } else {
        //     return back()->with([
        //         'eror' => 'The provided credentials do not match our records.',
        //     ]);
        // }

        //     $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $email = $request->email;
        $password = $request->password;

        // Hardcode credentials
        $accounts = [
            [
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'role' => 'admin'
            ],
            [
                'email' => 'user@user.com',
                'password' => 'user',
                'role' => 'user'
            ]
        ];

        // Ambil daftar user signup dari session
        $signup_users = $request->session()->get('signup_users', []);

        // Gabungkan akun hardcode dan signup
        $all_accounts = array_merge($accounts, $signup_users);

        foreach ($all_accounts as $account) {
            if ($email === $account['email'] && $password === $account['password']) {
                // Simpan info login ke session
                $request->session()->put('user', [
                    'email' => $account['email'],
                    'name' => $account['name'] ?? 'User',
                    'role' => $account['role']
                ]);

                if($account['role'] == 'user'){
                    return redirect()->route('home.show');
                }                
                else if ($account['role'] == 'admin'){
                    return redirect()->route('dashboard');
                }
            }
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->withInput();
    }

    public function signout(Request $request)
    {
        // Auth::logout();
        
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return redirect('signin.show');
        $request->session()->forget('user');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('signin.show');
    }
}
