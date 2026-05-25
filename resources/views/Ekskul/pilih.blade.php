@extends('layouts.app')
@section('title', 'Pilih Ekskul')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
    body, .content-wrap {
        background: #FDF6F0 !important;
        font-family: 'Nunito', sans-serif;
    }

    /* ── Blobs ── */
    .blob-bg { position: fixed; inset: 0; pointer-events: none; z-index: 0; overflow: hidden; }
    .blob-bg span { position: absolute; border-radius: 50%; opacity: .5; }
    .blob-bg .b1 { width:110px; height:110px; background:#F4A7B9; top:-25px;   left:-25px; }
    .blob-bg .b2 { width: 65px; height: 65px; background:#C4A9E0; top: 15px;   left:120px; }
    .blob-bg .b3 { width: 75px; height: 75px; background:#F9D976; top: 55px;   left: 65px; opacity:.45; }
    .blob-bg .b4 { width:120px; height:120px; background:#F4A7B9; bottom:20px; right:-25px; opacity:.35; }
    .blob-bg .b5 { width: 60px; height: 60px; background:#C4A9E0; bottom:90px; right:100px; opacity:.4; }

    /* ── Top Bar ── */
    .top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.8rem;
        position: relative;
        z-index: 2;
    }

    .top-brand {
        display: flex;
        align-items: center;
        gap: .7rem;
    }

    .brand-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }
    
    .brand-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
    }

    .brand-text .name {
        font-size: .9rem;
        font-weight: 700;
        color: #3a4a3a;
    }

    .brand-text .subtitle {
        font-size: .75rem;
        color: #888;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        min-width: 110px;
        font-size: .98rem;
        background: #fff;
        color: #a855f7;
        border: 1px solid rgba(168,85,247,.35);
        border-radius: 999px;
        padding: .65rem 1.1rem;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(168,85,247,.12);
        cursor: pointer;
    }

    /* ── Selection Title ── */
    .selection-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #3a4a3a;
        text-align: center;
        margin-bottom: 1.8rem;
        position: relative;
        z-index: 2;
    }

    /* ── Ekskul Grid ── */
    .ekskul-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.4rem;
        margin-bottom: 1.8rem;
        position: relative;
        z-index: 2;
    }

    .ekskul-item {
        background: #f3eeff;
        border: 2px solid transparent;
        border-radius: 20px;
        padding: 1.2rem 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: .85rem;
        font-size: .88rem;
        font-weight: 700;
        cursor: pointer;
        color: #4a3a5a;
        transition: border-color .2s, background .2s, transform .15s;
        position: relative;
        min-height: 160px;
        font-family: 'Nunito', sans-serif;
    }

    .ekskul-item:hover {
        border-color: #C4A9E0;
        background: #ede4fd;
        transform: translateY(-2px);
    }

    .ekskul-item input[type=checkbox] {
        display: none;
    }

    .ekskul-item.selected {
        border-color: #A07BC0;
        background: #F0E5FC;
        color: #6a3a9a;
    }

    .ekskul-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: #fff;
        border: 2px solid #C4A9E0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        flex-shrink: 0;
        transition: background .2s, border-color .2s;
    }

    .ekskul-item.selected .ekskul-icon {
        background: #A07BC0;
        border-color: #A07BC0;
        color: white;
    }

    .ekskul-name {
        text-align: center;
        line-height: 1.3;
    }

    /* ── Button ── */
    .next-btn {
        width: 100%;
        max-width: 300px;
        display: block;
        margin: 1.5rem auto 0;
        padding: .95rem 2rem;
        border-radius: 50px;
        border: none;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        font-weight: 800;
        background: linear-gradient(90deg, #C4A9E0, #F4A7B9);
        color: white;
        cursor: pointer;
        box-shadow: 0 5px 18px rgba(196,169,224,.45);
        transition: transform .2s, box-shadow .2s;
        position: relative;
        z-index: 2;
    }

    .next-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 24px rgba(196,169,224,.55);
    }

    @media(max-width:768px) {
        .ekskul-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .top-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: .5rem;
        }
    }
</style>
@endpush

@section('content')

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
    @csrf
</form>

<div class="blob-bg" aria-hidden="true">
    <span class="b1"></span><span class="b2"></span>
    <span class="b3"></span><span class="b4"></span><span class="b5"></span>
</div>

<div class="top-bar">
    <div class="top-brand">
        <div class="brand-avatar">
            <img src="{{ asset('images/laptop wallpaper 2.jpg') }}" alt="Profile">
        </div>
        <div class="brand-text">
            <div class="name">Rovlok High School</div>
            <div class="subtitle">Choose your favorite extracurricular</div>
        </div>
    </div>
    <a href="#" class="back-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">← Logout</a>
</div>

<div class="selection-title">Pilih Ekstrakurikuler Favorit</div>

<form method="POST" action="{{ route('ekskul.simpan-pilihan') }}">
    @csrf

    <div class="ekskul-grid">
        @foreach ($ekskuls as $ekskul)
            <label class="ekskul-item {{ in_array($ekskul->slug, $terpilih) ? 'selected' : '' }}" onclick="toggleItem(this)">
                <input type="checkbox" name="ekskul_ids[]" value="{{ $ekskul->id }}" {{ in_array($ekskul->slug, $terpilih) ? 'checked' : '' }}>
                <div class="ekskul-icon">{{ $ekskul->icon }}</div>
                <div class="ekskul-name">{{ $ekskul->nama }}</div>
            </label>
        @endforeach
    </div>

    <button type="submit" class="next-btn">Lanjut →</button>
</form>

@if ($errors->any())
    <div class="alert-warn">
        {{ $errors->first() }}
    </div>
@endif

@push('scripts')
<script>
    function toggleItem(el) {
        const cb = el.querySelector('input[type=checkbox]');
        setTimeout(() => {
            el.classList.toggle('selected', cb.checked);
        }, 0);
    }
</script>
@endpush

@endsection