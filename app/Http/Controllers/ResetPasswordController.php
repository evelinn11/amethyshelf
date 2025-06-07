<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    // Tampilkan form lupa password
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Kirim kode unik ke email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Generate token
        $token = Str::random(6); // Kode 6 digit

        // Simpan ke database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Kirim email
        Mail::to($request->email)->send(new PasswordResetMail($token));

        return back()->with('status', 'Kode verifikasi telah dikirim ke email Anda!');
    }

    // Tampilkan form reset password
    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset', ['token' => $request->token]);
    }

    // Proses reset password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset) {
            return back()->withErrors(['email' => 'Kode verifikasi tidak valid!']);
        }

        // Update password user
        $user = \App\Models\User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Hapus token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('status', 'Password berhasil direset!');
    }
}