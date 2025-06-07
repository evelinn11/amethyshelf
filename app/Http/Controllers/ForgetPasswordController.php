<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\PasswordResetMail;
use App\Models\User;

class ForgetPasswordController extends Controller
{
    //
    public function show()
    {
        return view('auth.forgetpassword');
    }

    public function sendVerification(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak terdaftar!']);
        }
        $token = random_int(100000, 999999); // 6 digit angka agar tidak dianggap spam
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        Mail::to($request->email)->send(new PasswordResetMail($token));
        // Simpan pesan sukses ke session biasa agar tidak hilang setelah redirect kedua
        session(['alert_success' => 'Kode verifikasi telah dikirim ke email Anda!']);
        return redirect()->route('changepassword.show')->with(['reset_email' => $request->email, 'reset_token' => $token]);
    }

    public function showChangePassword(Request $request)
    {
        // Ambil pesan sukses dari session biasa, lalu hapus agar hanya tampil sekali
        $alert_success = session('alert_success');
        if ($alert_success) {
            session()->forget('alert_success');
        }
        $reset_email = $request->session()->get('reset_email', '');
        return view('auth.forgetpassword', [
            'alert_success' => $alert_success,
            'reset_email' => $reset_email
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:4',
            'repeat_password' => 'required|same:password',
        ]);
        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();
        if (!$reset) {
            return back()->withErrors(['token' => 'Kode verifikasi salah atau sudah kadaluarsa!'])->withInput();
        }
        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('signin.show')->with('success', 'Password changed successfully! Please sign in.');
    }
}
