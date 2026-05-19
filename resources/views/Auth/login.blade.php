@extends('layouts.app')
@section('title', 'Login')

@push('styles')
<style>
    /* sembunyikan navbar kalau mau full immersive — hapus ini kalau navbar tetap muncul */
    body { background: #fdf0eb; overflow: hidden; }

    /* ── FULL PAGE CONTAINER ── */
    .login-fullpage {
        position: fixed;
        inset: 0;
        display: flex;
        font-family: 'Nunito', sans-serif;
        z-index: 999;
    }

    /* ── KIRI: GAMBAR PENUH ── */
    .lp-left {
        flex: 0 0 48%;
        position: relative;
        overflow: hidden;
    }
    .lp-left img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }

    /* wave organik di tepi kanan panel gambar */
    .lp-wave {
        position: absolute;
        top: 0; right: -1px;
        height: 100%;
        width: 90px;
    }

    /* ── KANAN: FORM PENUH ── */
    .lp-right {
        flex: 1;
        background: #fdf0eb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px 64px;
        position: relative;
        overflow: hidden;
    }

    /* dot dekorasi */
    .lp-dot {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .lp-dot-1 { width:22px; height:22px; background:#f48fb1; top:18%; right:18%; }
    .lp-dot-2 { width:14px; height:14px; background:#a5d6a7; top:24%; right:12%; }
    .lp-dot-3 { width:26px; height:26px; background:#fce4b0; bottom:20%; right:14%; }
    .lp-dot-4 { width:12px; height:12px; background:#f48fb1; bottom:28%; left:10%; opacity:.5; }

    /* form inner wrapper — max width biar ga terlalu lebar */
    .lp-form-wrap {
        width: 100%;
        max-width: 360px;
    }

    /* ── JUDUL ── */
    .lp-title {
        font-family: 'Playfair Display', serif;
        font-size: 52px;
        font-weight: 600;
        color: #6dbf72;
        margin-bottom: 32px;
        line-height: 1;
        letter-spacing: -1px;
    }

    /* ── ERROR ── */
    .lp-error {
        background: #fce4ec;
        border: 1px solid #f8bbd0;
        border-radius: 14px;
        padding: 10px 16px;
        font-size: 13px;
        color: #c62828;
        margin-bottom: 16px;
    }

    /* ── FIELD ── */
    .lp-field {
        position: relative;
        margin-bottom: 14px;
    }
    .lp-field-icon {
        position: absolute;
        left: 16px; top: 50%;
        transform: translateY(-50%);
        font-size: 16px; line-height: 1;
        color: #bbb;
    }
    .lp-field input {
        width: 100%;
        padding: 14px 18px 14px 44px;
        border: 1.5px solid #ecddd6;
        border-radius: 50px;
        background: #fff;
        font-family: 'Nunito', sans-serif;
        font-size: 14px; color: #5d4037;
        outline: none;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        transition: border-color .2s, box-shadow .2s;
    }
    .lp-field input:focus {
        border-color: #a5d6a7;
        box-shadow: 0 0 0 3px rgba(165,214,167,.22);
    }
    .lp-field input::placeholder { color: #ccc; font-size: 13px; }

    /* ── REMEMBER ── */
    .lp-remember {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: #b0a09a;
        margin-bottom: 22px; margin-top: 4px;
    }
    .lp-remember input[type=checkbox] {
        width: 16px; height: 16px;
        accent-color: #81c784;
        cursor: pointer; padding: 0;
        border-radius: 4px;
    }
    .lp-remember label {
        margin: 0; cursor: pointer;
        font-size: 13px; color: #b0a09a; font-weight: 400;
    }

    /* ── BUTTON ── */
    .lp-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #6dbf72, #a5d6a7);
        border: none; border-radius: 50px;
        color: #fff;
        font-family: 'Nunito', sans-serif;
        font-size: 16px; font-weight: 800;
        cursor: pointer;
        margin-bottom: 22px;
        transition: transform .15s, box-shadow .15s;
    }
    .lp-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(109,191,114,.45);
    }
    .lp-btn:active { transform: translateY(0); }

    /* ── LINKS ── */
    .lp-register-link {
        font-size: 13px; color: #b0a09a;
        margin-bottom: 8px;
    }
    .lp-register-link a {
        color: #e06fa0; font-weight: 700; text-decoration: none;
    }
    .lp-register-link a:hover { text-decoration: underline; }
    .lp-footer-note {
        font-size: 11px; color: #cbbfb8;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 700px) {
        .login-fullpage { flex-direction: column; }
        .lp-left { flex: 0 0 220px; }
        .lp-wave { display: none; }
        .lp-right { padding: 36px 28px; overflow-y: auto; }
        .lp-title { font-size: 38px; }
        body { overflow: auto; }
        .login-fullpage { position: relative; min-height: 100dvh; }
    }
</style>
@endpush

@section('content')

<div class="login-fullpage">

    {{-- ══ KIRI: GAMBAR ══ --}}
    <div class="lp-left">
        {{-- Ganti URL ini dengan asset gambar lokal kamu --}}
        {{-- <img src="{{ asset('images/foto-sekolah.jpg') }}" alt="EkSmart"> --}}
        <img src="https://images.unsplash.com/photo-1508739773434-c26b3d09e071?w=900&q=80" alt="EkSmart">

        {{-- Wave SVG organik --}}
        <svg class="lp-wave" viewBox="0 0 90 900" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M90,0 C55,150 15,200 40,450 C65,700 20,750 90,900 L90,0 Z" fill="#fdf0eb"/>
        </svg>
    </div>

    {{-- ══ KANAN: FORM ══ --}}
    <div class="lp-right">
        <div class="lp-dot lp-dot-1"></div>
        <div class="lp-dot lp-dot-2"></div>
        <div class="lp-dot lp-dot-3"></div>
        <div class="lp-dot lp-dot-4"></div>

        <div class="lp-form-wrap">

            <div class="lp-title">Login</div>

            @if ($errors->any())
                <div class="lp-error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="lp-field">
                    <span class="lp-field-icon">👤</span>
                    <input type="text" id="nomor_siswa" name="nomor_siswa"
                           value="{{ old('nomor_siswa') }}"
                           placeholder="Nomor Siswa"
                           required autofocus>
                </div>

                <div class="lp-field">
                    <span class="lp-field-icon">🔒</span>
                    <input type="password" id="password" name="password"
                           placeholder="Masukkan password"
                           required>
                </div>

                <div class="lp-remember">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="lp-btn">Masuk ✨</button>

            </form>

            <div class="lp-register-link">
                Belum punya akun?
                <a href="{{ route('register') }}">Daftar di sini</a>
            </div>

            <div class="lp-footer-note">XI RPL 2 · Tahun Ajaran 2024/2025</div>

        </div>
    </div>

</div>

@endsection