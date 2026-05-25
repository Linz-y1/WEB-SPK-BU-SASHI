@extends('layouts.app')
@section('title', 'Daftar Akun')

@push('styles')
<style>
    body { background: #fdf0eb; overflow: hidden; }

    /* ── FULL PAGE CONTAINER ── */
    .register-fullpage {
        position: fixed;
        inset: 0;
        display: flex;
        font-family: 'Nunito', sans-serif;
        z-index: 999;
    }

    /* ── KIRI: FORM ── */
    .rp-left {
        flex: 1;
        background: #fdf0eb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 64px;
        position: relative;
        overflow: hidden;
    }

    /* dot dekorasi */
    .rp-dot {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .rp-dot-1 { width:22px; height:22px; background:#f48fb1; top:10%; right:18%; }
    .rp-dot-2 { width:14px; height:14px; background:#a5d6a7; top:16%; right:11%; }
    .rp-dot-3 { width:26px; height:26px; background:#fce4b0; bottom:12%; right:14%; }
    .rp-dot-4 { width:12px; height:12px; background:#f48fb1; bottom:20%; left:10%; opacity:.5; }

    /* form inner wrapper */
    .rp-form-wrap {
        width: 100%;
        max-width: 360px;
    }

    /* ── JUDUL ── */
    .rp-title {
        font-family: 'Playfair Display', serif;
        font-size: 44px;
        font-weight: 600;
        color: #e06fa0;
        margin-bottom: 24px;
        line-height: 1;
        letter-spacing: -1px;
    }

    /* ── ERROR ── */
    .rp-error {
        background: #fce4ec;
        border: 1px solid #f8bbd0;
        border-radius: 14px;
        padding: 10px 16px;
        font-size: 13px;
        color: #c62828;
        margin-bottom: 14px;
    }
    .rp-error ul { margin: 0; padding-left: 16px; }
    .rp-error li { margin-bottom: 3px; }

    /* ── FIELD ── */
    .rp-field {
        position: relative;
        margin-bottom: 12px;
    }
    .rp-field-icon {
        position: absolute;
        left: 16px; top: 50%;
        transform: translateY(-50%);
        font-size: 15px; line-height: 1;
        color: #bbb;
    }
    .rp-field input {
        width: 100%;
        padding: 13px 18px 13px 44px;
        border: 1.5px solid #f8d0e0;
        border-radius: 50px;
        background: #fff8fb;
        font-family: 'Nunito', sans-serif;
        font-size: 14px; color: #7a3050;
        outline: none;
        box-shadow: 0 2px 10px rgba(230,100,150,.06);
        transition: border-color .2s, box-shadow .2s;
    }
    .rp-field input:focus {
        border-color: #f48fb1;
        box-shadow: 0 0 0 3px rgba(244,143,177,.18);
        background: #fff;
    }
    .rp-field input::placeholder { color: #e0b8c8; font-size: 13px; }

    /* ── BUTTON ── */
    .rp-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #e06fa0, #f48fb1);
        border: none; border-radius: 50px;
        color: #fff;
        font-family: 'Nunito', sans-serif;
        font-size: 16px; font-weight: 800;
        cursor: pointer;
        margin-top: 6px;
        margin-bottom: 20px;
        transition: transform .15s, box-shadow .15s;
    }
    .rp-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(224,111,160,.4);
    }
    .rp-btn:active { transform: translateY(0); }

    /* ── LINKS ── */
    .rp-login-link {
        font-size: 13px; color: #c0a0a8;
        margin-bottom: 8px;
    }
    .rp-login-link a {
        color: #e06fa0; font-weight: 700; text-decoration: none;
    }
    .rp-login-link a:hover { text-decoration: underline; }
    .rp-footer-note {
        font-size: 11px; color: #d0b8c0;
    }

    /* ── KANAN: GAMBAR ── */
    .rp-right {
        flex: 0 0 48%;
        position: relative;
        overflow: hidden;
    }
    .rp-right img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }

    /* wave organik di tepi kiri gambar */
    .rp-wave {
        position: absolute;
        top: 0; left: -1px;
        height: 100%;
        width: 90px;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 700px) {
        .register-fullpage { flex-direction: column; position: relative; min-height: 100dvh; }
        .rp-right { flex: 0 0 200px; }
        .rp-wave { display: none; }
        .rp-left { padding: 32px 24px; overflow-y: auto; justify-content: flex-start; }
        .rp-title { font-size: 34px; }
        body { overflow: auto; }
    }
</style>
@endpush

@section('content')

<div class="register-fullpage">

    {{-- ══ KIRI: FORM ══ --}}
    <div class="rp-left">
        <div class="rp-dot rp-dot-1"></div>
        <div class="rp-dot rp-dot-2"></div>
        <div class="rp-dot rp-dot-3"></div>
        <div class="rp-dot rp-dot-4"></div>

        <div class="rp-form-wrap">

            <div class="rp-title">Daftar</div>

            @if ($errors->any())
                <div class="rp-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="rp-field">
                    <span class="rp-field-icon">👤</span>
                    <input type="text" id="nama" name="nama"
                           value="{{ old('nama') }}"
                           placeholder="Nama Lengkap"
                           required autofocus>
                </div>

                <div class="rp-field">
                    <span class="rp-field-icon">🎫</span>
                    <input type="text" id="nomor_siswa" name="nomor_siswa"
                           value="{{ old('nomor_siswa') }}"
                           placeholder="Nomor Siswa (contoh: 0012345678)"
                           required>
                </div>

                <div class="rp-field">
                    <span class="rp-field-icon">🏫</span>
                    <input type="text" id="kelas" name="kelas"
                           value="{{ old('kelas') }}"
                           placeholder="Kelas (contoh: XI RPL 2)"
                           required>
                </div>

                <div class="rp-field">
                    <span class="rp-field-icon">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="Buat password"
                           required>
                </div>

                <div class="rp-field">
                    <span class="rp-field-icon">🔑</span>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           placeholder="Ulangi password"
                           required>
                </div>

                <button type="submit" class="rp-btn">Daftar Sekarang 🚀</button>

            </form>

            <div class="rp-login-link">
                Sudah punya akun?
                <a href="{{ route('login') }}">Login di sini</a>
            </div>

            <div class="rp-footer-note">XI RPL 2 · Tahun Ajaran 2024/2025</div>

        </div>
    </div>

    {{-- ══ KANAN: GAMBAR ══ --}}
    <div class="rp-right">
        {{-- Ganti dengan foto lokal: <img src="{{ asset('images/laptop wallpaper 2.jpg') }}" alt="EkSmart"> --}}
        <img src="{{ asset('images/laptop wallpaper 2.jpg') }}" alt="EkSmart">

        {{-- Wave SVG organik — melengkung ke kiri --}}
        <svg class="rp-wave" viewBox="0 0 90 900" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 C35,150 75,200 50,450 C25,700 70,750 0,900 L0,0 Z" fill="#fdf0eb"/>
        </svg>
    </div>

</div>

@endsection