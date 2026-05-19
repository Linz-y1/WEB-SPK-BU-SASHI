@extends('layouts.app')
@section('title', 'Pilih Ekskul')

@push('styles')
<style>
    .page-shell{
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        padding: 1.3rem 1.5rem 1.8rem;
        background: #fff;
        border-radius: 24px;
        border: 1px solid #f1d4d4;
        box-shadow: 0 18px 55px rgba(0,0,0,.08);
        position: relative;
    }

    .top-bar{
        background: #d8efc8;
        border-radius: 10px;
        padding: .9rem 1.2rem;
        margin-bottom: 1.2rem;
        box-shadow: none;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .top-brand{
        display:flex;
        align-items:center;
        gap:.7rem;
    }
    .back-link{
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:.35rem;
        min-width:110px;
        font-size:.98rem;
        background:#fff;
        color:#a855f7;
        border:1px solid rgba(168,85,247,.35);
        border-radius:999px;
        padding:.65rem 1.1rem;
        text-decoration:none;
        font-weight:700;
        box-shadow:0 5px 15px rgba(168,85,247,.12);
    }

    .brand-avatar{
        width:40px;
        height:40px;
        border-radius:50%;
        background:#f4b6c2;
        color:#fff;
        display:grid;
        place-items:center;
        font-weight:bold;
        font-size:.9rem;
    }

    .brand-text{
        display:flex;
        flex-direction:column;
    }

    .brand-text .name{
        font-size:.8rem;
        font-weight:600;
        color:#666;
    }

    .brand-text .subtitle{
        font-size:.7rem;
        color:#aaa;
    }

    .selection-card{
        background: #fff6f8;
        border-radius: 22px;
        padding: 1.8rem 1.7rem 1.6rem;
        border: 1px solid #f3d7dd;
        box-shadow: inset 0 2px 10px rgba(255,255,255,.6);
    }

    .selection-heading.simple{
        justify-content:center;
        text-align:center;
        margin-bottom:1.5rem;
    }

    .selection-title{
        font-family: 'Fredoka One', cursive;
        font-size:1.6rem;
        color:#7d3d3d;
    }

    .ekskul-grid{
        display:grid;
        grid-template-columns: repeat(4,1fr);
        gap:1.4rem;
        justify-items:center;
    }

    .ekskul-item{
        width:150px;
        min-height:180px;
        background:#fff;
        border:1px solid #f2d6dc;
        border-radius:20px;
        padding:1rem;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        gap:.85rem;
        transition:.2s;
        cursor:pointer;
        position:relative;
    }

    .ekskul-item:hover{
        transform:translateY(-3px);
    }

    .ekskul-item.selected{
        border:2px solid #e78fb3;
        background:#fff5fa;
    }

    .ekskul-item input[type=checkbox]{
        position:absolute;
        opacity:0;
    }

    .ekskul-icon{
        width:72px;
        height:72px;
        border-radius:20px;
        background:#fff7f7;
        display:grid;
        place-items:center;
        font-size:2.8rem;
    }

    .ekskul-name{
        font-size:.85rem;
        text-align:center;
        font-weight:600;
        color:#444;
        line-height:1.1;
    }

    .next-btn{
        display:block;
        margin:1.7rem auto 0;
        border:none;
        background: linear-gradient(135deg, #db2777, #e879f9);
        color:#fff;
        padding:.95rem 3rem;
        border-radius:999px;
        font-weight:700;
        font-size:1rem;
        box-shadow:0 10px 30px rgba(219,39,119,.2);
        cursor:pointer;
        transition:.2s;
    }

    .next-btn:hover{
        transform:translateY(-2px);
    }

    @media(max-width:768px){
        .ekskul-grid{
            grid-template-columns:repeat(2,1fr);
        }
    }
</style>
@endpush

@section('content')

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
    @csrf
</form>

<div class="page-shell">

    <div class="top-bar">
        <div class="top-brand">
            <div class="brand-avatar">S</div>
            <div class="brand-text">
                <div class="name">Serevina High School</div>
                <div class="subtitle">Choose your favorite extracurricular</div>
            </div>
        </div>
        <a href="#" class="back-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">← Back to Login</a>
    </div>

    <div class="selection-card">
        <div class="selection-heading simple">
            <div>
                <div class="selection-title">Choose Your Favorite Extracurricular</div>
            </div>
        </div>

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

            <button type="submit" class="next-btn">Next</button>
        </form>
    </div>
</div>

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