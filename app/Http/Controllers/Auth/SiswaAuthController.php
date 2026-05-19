<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SiswaAuthController extends Controller
{
    // ─── REGISTER ────────────────────────────────────────────────

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'         => ['required', 'string', 'max:255'],
            'nomor_siswa'  => ['required', 'string', 'max:20', 'unique:siswas'],
            'kelas'        => ['required', 'string', 'max:20'],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'nomor_siswa.unique' => 'Nomor siswa sudah terdaftar.',
        ]);

        $siswa = Siswa::create([
            'nama'        => $request->nama,
            'nomor_siswa' => $request->nomor_siswa,
            'kelas'       => $request->kelas,
            'password'    => Hash::make($request->password),
        ]);

        Auth::guard('siswa')->login($siswa);

        return redirect()->route('ekskul.pilih');
    }

    // ─── LOGIN ───────────────────────────────────────────────────

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nomor_siswa' => ['required', 'string'],
            'password'    => ['required', 'string'],
        ]);

        $credentials = [
            'nomor_siswa' => $request->nomor_siswa,
            'password'    => $request->password,
        ];

        if (Auth::guard('siswa')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $siswa = Auth::guard('siswa')->user();

            // Kalau sudah punya hasil, langsung ke halaman hasil
            if ($siswa->hasilRekomendasi) {
                return redirect()->route('ekskul.hasil');
            }

            // Kalau belum pilih ekskul
            if ($siswa->ekskuls->isEmpty()) {
                return redirect()->route('ekskul.pilih');
            }

            return redirect()->route('ekskul.kuis');
        }

        // Jika tidak berhasil login sebagai siswa, coba login sebagai user (admin)
        $userLogin = $request->nomor_siswa;
        if (Auth::attempt(['email' => $userLogin, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if (($user->role ?? 'user') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // jika bukan admin, logout dan tampilkan error
            Auth::logout();
        }

        return back()->withErrors([
            'nomor_siswa' => 'Nomor siswa atau password salah.',
        ])->onlyInput('nomor_siswa');
    }

    // ─── LOGOUT ──────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}