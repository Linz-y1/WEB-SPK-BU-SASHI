@extends('layouts.app')
@section('title', 'Hasil Rekomendasi')

@push('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body { background-color: #fdf0e8 !important; font-family: 'Georgia', serif; }

    .slide {
        width: 100vw;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        background-color: #fdf0e8;
    }

    .c { position: absolute; border-radius: 50%; }

    .c1  { width: 70px;  height: 70px;  background: #c8a8e0; top: 6%;     left: 4%;    opacity:0.8; }
    .c2  { width: 32px;  height: 32px;  background: #b8e0b8; top: 14%;    left: 17%;   opacity:0.8; }
    .c3  { width: 28px;  height: 28px;  background: #f5e870; top: 5%;     left: 42%;   opacity:0.85; }
    .c4  { width: 40px;  height: 40px;  background: #b8e0b8; top: 6%;     right: 18%;  opacity:0.8; }
    .c5  { width: 60px;  height: 60px;  background: #f4a0b8; top: 3%;     right: 4%;   opacity:0.8; }
    .c6  { width: 35px;  height: 35px;  background: #f4a0b8; top: 46%;    left: 4%;    opacity:0.8; }
    .c7  { width: 30px;  height: 30px;  background: #a8c8f0; top: 62%;    left: 10%;   opacity:0.75; }
    .c8  { width: 32px;  height: 32px;  background: #c8a8e0; top: 50%;    right: 5%;   opacity:0.75; }
    .c9  { width: 70px;  height: 70px;  background: #f4a0b8; bottom: 8%;  left: 8%;    opacity:0.8; }
    .c10 { width: 35px;  height: 35px;  background: #b8e0b8; bottom: 13%; left: 35%;   opacity:0.8; }
    .c11 { width: 70px;  height: 70px;  background: #f5c89a; bottom: 5%;  left: 50%;   opacity:0.8; }
    .c12 { width: 38px;  height: 38px;  background: #b8e0b8; bottom: 16%; right: 8%;   opacity:0.75; }
    .c13 { width: 50px;  height: 50px;  background: #f4a0b8; bottom: 4%;  right: 4%;   opacity:0.8; }

    .star { position: absolute; color: #e8a0b0; font-size: 2rem; opacity: 0.6; }
    .s1 { top: 20%; left: 8%; }
    .s2 { top: 35%; right: 8%; }
    .s3 { bottom: 30%; left: 6%; }
    .s4 { bottom: 20%; right: 10%; }

    .label {
        font-size: 0.82rem;
        color: #b5a09a;
        letter-spacing: 0.03em;
        z-index: 1;
        margin-bottom: 0.5rem;
    }

    .hasil-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 1.8rem 2.5rem;
        width: 85%;
        max-width: 420px;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 1.2rem;
        z-index: 1;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    .ekskul-icon-display {
        width: 75px;
        height: 75px;
        border-radius: 20px;
        background: #fff7f7;
        display: grid;
        place-items: center;
        font-size: 2.8rem;
        min-width: 75px;
    }

    .ekskul-info {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .ekskul-nama {
        font-size: 1.6rem;
        font-weight: 700;
        color: #333;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .ekskul-desc {
        font-size: 0.82rem;
        color: #666;
        line-height: 1.5;
    }

    .btn-tryagain {
        margin-top: 0.5rem;
        background: #ffffff;
        border: 1px solid #ccc;
        border-radius: 50px;
        padding: 0.35rem 1.8rem;
        font-size: 0.8rem;
        color: #666;
        text-decoration: none;
        display: inline-block;
        z-index: 1;
        position: relative;
    }
</style>
@endpush

@section('content')
<div class="slide">
    <div class="c c1"></div>
    <div class="c c2"></div>
    <div class="c c3"></div>
    <div class="c c4"></div>
    <div class="c c5"></div>
    <div class="c c6"></div>
    <div class="c c7"></div>
    <div class="c c8"></div>
    <div class="c c9"></div>
    <div class="c c10"></div>
    <div class="c c11"></div>
    <div class="c c12"></div>
    <div class="c c13"></div>

    <span class="star s1">✶</span>
    <span class="star s2">✶</span>
    <span class="star s3">✶</span>
    <span class="star s4">✶</span>

    <p class="label">Berdasarkan jawaban kamu...</p>

    @if ($ekskul)
    <div class="hasil-card">
        <div class="ekskul-icon-display">{{ $ekskul->icon }}</div>
        <div class="ekskul-info">
            <div class="ekskul-nama">{{ $ekskul->icon }} {{ $ekskul->nama }} {{ $ekskul->icon }}</div>
            <div class="ekskul-desc">{{ $ekskul->deskripsi }}</div>
        </div>
    </div>
    @endif

    <a href="{{ route('ekskul.pilih') }}" class="btn-tryagain">Try again</a>
</div>
@endsection