<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Cek username & password dulu
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek apakah akun aktif
            if ($user->status != 1) {
                Auth::logout();
                return redirect()->route('login')
                    ->with("error", "Akun Anda nonaktif, hubungi admin!");
            }

            // Generate OTP
            $otp = rand(100000, 999999);

            // Simpan OTP di session sementara
            Session::put('otp', $otp);
            Session::put('otp_user_id', $user->id);

            // Logout dulu sebelum OTP diverifikasi
            Auth::logout();

            // Kirim email OTP
            Mail::to($user->email)->send(new OtpMail($otp, $user->name));

            return redirect()->route('otp.form')
                ->with('success', 'Kode OTP telah dikirim ke email kamu!');
        }

        // Jika username / password salah
        return redirect()->route('login')
            ->with("error", "Username atau Password salah!");
    }

    public function showOtpForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $otp = Session::get('otp');
        $userId = Session::get('otp_user_id');

        if ($request->otp == $otp && $userId) {
            Auth::loginUsingId($userId);

            Session::forget('otp');
            Session::forget('otp_user_id');

            if (Auth::user()->level == 1) {
                return redirect()->intended('/admin/home');
            } elseif (Auth::user()->level == 4) {
                return redirect()->intended('/dokter/home');
            } else {
                return redirect()->intended('/admin/home');
            }
        } else {
            return redirect()->route('otp.form')->withErrors(['otp' => 'Kode OTP tidak valid!.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with("success", "Anda Berhasil Logout!");
    }

    public function resendOtp(Request $request)
    {
        $userId = Session::get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi Berakhir. Silahkan kirim kembali.');
        }

        $user = \App\Models\User::find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Pengguna Tidak Ditemukan!. Silahkan login kembali.');
        }

        $otp = rand(100000, 999999);

        Session::put('otp', $otp);

        Mail::to($user->email)->send(new \App\Mail\OtpMail($otp, $user->name));

        return redirect()->route('otp.form')->with('success', 'Kode berhasil dikirim ke email kamu! Silahkan login!');
    }
}
