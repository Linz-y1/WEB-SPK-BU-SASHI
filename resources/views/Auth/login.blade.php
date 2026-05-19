@extends('layouts.app')
@section('title', 'Login')

@section('content')

<div class="logo-area">
    <div class="logo-icon">🌟</div>
    <div class="logo-title">EkSmart</div>
    <div class="logo-sub">Pendaftaran Ekstrakurikuler Online</div>
</div>

<div class="card">
    <div class="card-title">Masuk ke Akunmu</div>

    @if ($errors->any())
        <div class="error-msg" style="margin-bottom:1rem">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div style="display:flex;flex-direction:column;gap:.9rem">
            <div>
                <label for="nomor_siswa">Nomor Siswa</label>
                <input type="text" id="nomor_siswa" name="nomor_siswa"
                       value="{{ old('nomor_siswa') }}"
                       placeholder="Contoh: 0012345678" required autofocus>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Masukkan password" required>
            </div>
            <div style="display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:var(--text-muted)">
                <input type="checkbox" name="remember" id="remember" style="width:auto">
                <label for="remember" style="margin:0;font-weight:400">Ingat saya</label>
            </div>
        </div>
        <div style="margin-top:1.25rem">
            <button type="submit" class="btn btn-primary">Masuk ✨</button>
        </div>
    </form>
</div>

<div style="text-align:center;font-size:.9rem;color:var(--text-muted)">
    Belum punya akun?
    <a href="{{ route('register') }}" style="color:var(--purple-dark);font-weight:700;text-decoration:none">Daftar di sini</a>
</div>

<div style="text-align:center;font-size:.78rem;color:var(--text-light)">
    XI RPL 2 · Tahun Ajaran 2024/2025
</div>

@endsection