<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    //
    public function show()
    {
        return view('auth.forgetpassword');
    }

    public function sendVerification(Request $request)
    {
        // Simulasi kirim kode verifikasi ke email
        // Redirect ke halaman email verification
        return redirect()->route('emailverification.show');
    }

    public function showChangePassword(Request $request)
    {
        // Tampilkan halaman change password, cek jika ada session sukses dari verifikasi
        $success = $request->session()->get('verification_success', false);
        return view('auth.forgetpassword', compact('success'));
    }

    public function changePassword(Request $request)
    {
        // Simulasi ganti password
        // Redirect ke signin
        return redirect()->route('signin.show')->with('success', 'Password changed successfully! Please sign in.');        
    }
}
