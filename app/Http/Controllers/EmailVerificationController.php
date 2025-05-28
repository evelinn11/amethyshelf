<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    //
        public function show()
    {
        return view('auth.emailverification');
    }

    public function verify(Request $request)
    {
        // Simulasi verifikasi kode
        // Jika gagal, bisa redirect back dengan error
        // Jika sukses, redirect ke halaman lain (misal: signin)
        return redirect()->route('changepassword.show')->with('success', 'Email verification successful! Please change your password.');    
    }
}
