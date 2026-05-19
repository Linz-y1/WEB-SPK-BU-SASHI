@extends('layouts.app')
@section('title', 'Terima Kasih')

@section('content')

<div style="text-align:center;padding:1.5rem 1rem">
    <div style="font-size:72px;margin-bottom:1rem">🎉</div>
    <div style="font-family:'Fredoka One',cursive;font-size:1.8rem;color:var(--purple-dark);margin-bottom:.5rem">
        Terimakasih<br>Sudah Menjawab!
    </div>
    <div style="font-size:.9rem;color:var(--text-muted);line-height:1.6">
        Jawabanmu sudah kami terima.<br>
        Kami sedang menganalisis potensi terbaikmu...
    </div>
</div>

<div class="card" style="text-align:center">
    <div style="font-size:2rem;margin-bottom:.5rem">🔍</div>
    <div style="font-weight:700;margin-bottom:.25rem">Analisis Sedang Berjalan</div>
    <div style="font-size:.85rem;color:var(--text-muted)">
        Berdasarkan jawaban kuis dan pilihan ekskul, kami akan menemukan ekskul yang paling cocok untukmu.
    </div>
</div>

<a href="{{ route('ekskul.hasil') }}" class="btn btn-success">
    Lihat Hasil Rekomendasi 🌟
</a>

<div class="dots-row">
    <span class="step-dot"></span>
    <span class="step-dot"></span>
    <span class="step-dot active"></span>
</div>

@endsection