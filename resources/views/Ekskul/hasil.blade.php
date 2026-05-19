@extends('layouts.app')
@section('title', 'Hasil Rekomendasi')

@push('styles')
<style>
    .result-card {
        background: linear-gradient(135deg, #7C3AED, #EC4899);
        border-radius: var(--radius); padding: 1.75rem 1.5rem;
        color: #fff; text-align: center;
    }
    .result-icon { font-size: 60px; margin-bottom: .75rem; }
    .result-title { font-family: 'Fredoka One', cursive; font-size: 1.6rem; margin-bottom: .25rem; }
    .result-sub { font-size: .85rem; opacity: .9; }
    .result-tag {
        display: inline-block; background: var(--purple-light); color: var(--purple-dark);
        font-size: .78rem; font-weight: 700; padding: .3rem .75rem;
        border-radius: 99px; margin: .25rem .2rem;
    }
    .info-card { background: #F0FDF4; border: 1.5px solid #86EFAC; border-radius: var(--radius); padding: 1.25rem 1.5rem; }
</style>
@endpush

@section('content')

<div class="header-row">
    <a href="{{ route('ekskul.terimakasih') }}" class="back-btn">←</a>
    <div class="page-title">Hasil Rekomendasi</div>
</div>

@if ($ekskul)
<div class="result-card">
    <div class="result-icon">{{ $ekskul->icon }}</div>
    <div class="result-title">{{ $ekskul->nama }}</div>
    <div class="result-sub">Ekskul terbaik untukmu!</div>
</div>

<div class="card">
    <p style="font-size:.9rem;line-height:1.6;color:var(--text)">
        {{ $ekskul->deskripsi }}
    </p>
</div>

<div style="margin-top:-.5rem">
    <span class="result-tag">Kreatif</span>
    <span class="result-tag">Berbakat</span>
    <span class="result-tag">Berprestasi</span>
</div>
@else
<div class="card" style="text-align:center">
    <p style="color:var(--text-muted)">Data rekomendasi tidak ditemukan.</p>
</div>
@endif

<div class="info-card">
    <div style="font-weight:700;color:#166534;margin-bottom:.5rem">📋 Informasi Pendaftaran</div>
    <div style="font-size:.85rem;color:#15803D;line-height:1.7">
        Halo <strong>{{ $siswa->nama }}</strong>, silakan lapor ke wali kelas atau bagian kesiswaan
        untuk mendaftar ekskul pilihanmu.<br>
        <strong>Batas pendaftaran: 30 Agustus 2025</strong>
    </div>
</div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-primary">Keluar 🔄</button>
</form>

@endsection