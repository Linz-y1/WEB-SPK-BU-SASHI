@extends('layouts.app')
@section('title', 'Daftar Akun')

@section('content')

<div class="logo-area">
    <div class="logo-icon">🌟</div>
    <div class="logo-title">EkSmart</div>
    <div class="logo-sub">Buat Akun Baru</div>
</div>

<div class="card">
    <div class="card-title">Daftar Akun</div>

    @if ($errors->any())
        <div class="error-msg" style="margin-bottom:1rem">
            <ul style="margin:0;padding-left:1rem">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div style="display:flex;flex-direction:column;gap:.9rem">
            <div>
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Contoh: Asha Devika Kalyani" required autofocus>
            </div>
            <div>
                <label for="nomor_siswa">Nomor Siswa</label>
                <input type="text" id="nomor_siswa" name="nomor_siswa"
                       value="{{ old('nomor_siswa') }}"
                       placeholder="Contoh: 0012345678" required>
            </div>
            <div>
                <label for="kelas">Kelas</label>
                <input type="text" id="kelas" name="kelas"
                       value="{{ old('kelas') }}"
                       placeholder="Contoh: XI RPL 2" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Buat password" required>
            </div>
            <div>
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       placeholder="Ulangi password" required>
            </div>
        </div>
        <div style="margin-top:1.25rem">
            <button type="submit" class="btn btn-primary">Daftar Sekarang 🚀</button>
        </div>
    </form>
</div>

<div style="text-align:center;font-size:.9rem;color:var(--text-muted)">
    Sudah punya akun?
    <a href="{{ route('login') }}" style="color:var(--purple-dark);font-weight:700;text-decoration:none">Login di sini</a>
</div>

@endsection