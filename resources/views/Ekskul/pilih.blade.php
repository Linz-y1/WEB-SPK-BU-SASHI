@extends('layouts.app')
@section('title', 'Pilih Ekskul')

@push('styles')
<style>
    .ekskul-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
    .ekskul-item {
        background: var(--white); border: 2px solid #E5E7EB;
        border-radius: calc(var(--radius-sm) * 1.2); padding: 1rem;
        text-align: center; cursor: pointer; transition: all .2s;
        display: flex; flex-direction: column; align-items: center; gap: .5rem;
        position: relative; min-height: 220px;
    }
    .ekskul-item:hover { border-color: var(--purple); background: var(--purple-light); }
    .ekskul-item.selected { border-color: var(--purple-dark); background: var(--purple-light); box-shadow: 0 0 0 3px rgba(124,58,237,.15); }
    .ekskul-item input[type=checkbox] { position: absolute; opacity: 0; width: 0; height: 0; }
    .ekskul-icon {
        font-size: 4rem; line-height: 1; width: 5.5rem; height: 5.5rem;
        display: grid; place-items: center; background: rgba(124,58,237,.08);
        border-radius: 50%; margin-bottom: .25rem;
    }
    .ekskul-name { display: none; }
</style>
@endpush

@section('content')

<div class="header-row">
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="back-btn" title="Keluar">←</a>
    <div class="page-title">Pilih Minatmu</div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>

<div class="tag-nama">Halo, {{ auth('siswa')->user()->nama }} 👋</div>

@if ($errors->any())
    <div class="alert-warn">{{ $errors->first() }}</div>
@endif

<form method="POST" action="{{ route('ekskul.simpan-pilihan') }}">
    @csrf
    <div class="card">
        <div class="card-title">Ekstrakurikuler apa yang menarik bagimu?</div>
        <div class="ekskul-grid">
            @foreach ($ekskuls as $ekskul)
                <label class="ekskul-item {{ in_array($ekskul->slug, $terpilih) ? 'selected' : '' }}"
                       onclick="toggleItem(this)">
                    <input type="checkbox" name="ekskul_ids[]" value="{{ $ekskul->id }}"
                           {{ in_array($ekskul->slug, $terpilih) ? 'checked' : '' }}>
                    <div class="ekskul-icon" title="{{ $ekskul->nama }}">{{ $ekskul->icon }}</div>
                    <div class="ekskul-name">{{ $ekskul->nama }}</div>
                </label>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Lanjut ke Kuis →</button>
</form>

<div class="dots-row">
    <span class="step-dot active"></span>
    <span class="step-dot"></span>
    <span class="step-dot"></span>
</div>

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