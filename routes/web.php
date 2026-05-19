<?php

use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\EkskulController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ─── REDIRECT ROOT ───────────────────────────────────────────────
Route::get('/', function () {
    return Auth::guard('siswa')->check()
        ? redirect()->route('ekskul.pilih')
        : redirect()->route('login');
});

// Optional home endpoint for authenticated siswa redirects
Route::get('/home', function () {
    return Auth::guard('siswa')->check()
        ? redirect()->route('ekskul.pilih')
        : redirect()->route('login');
});

// ─── AUTH ────────────────────────────────────────────────────────
Route::middleware('guest:siswa')->group(function () {
    Route::get('/register', [SiswaAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [SiswaAuthController::class, 'register']);

    Route::get('/login', [SiswaAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [SiswaAuthController::class, 'login']);
});

Route::post('/logout', [SiswaAuthController::class, 'logout'])
    ->middleware('auth:siswa')
    ->name('logout');

// ─── EKSKUL (wajib login) ────────────────────────────────────────
Route::middleware('auth:siswa')->prefix('ekskul')->name('ekskul.')->group(function () {
    Route::get('/pilih',   [EkskulController::class, 'pilih'])->name('pilih');
    Route::post('/pilih',  [EkskulController::class, 'simpanPilihan'])->name('simpan-pilihan');

    Route::get('/kuis',    [EkskulController::class, 'kuis'])->name('kuis');
    Route::post('/kuis',   [EkskulController::class, 'simpanJawaban'])->name('simpan-jawaban');

    Route::get('/terimakasih', [EkskulController::class, 'terimakasih'])->name('terimakasih');
    Route::get('/hasil',       [EkskulController::class, 'hasil'])->name('hasil');
});

// Admin routes (separate file)
require __DIR__ . '/web_admin.php';