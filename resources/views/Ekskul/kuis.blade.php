@extends('layouts.app')

@section('title', 'Kuis Kemampuan')

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

    /* ── Progress ── */
    .progress-label {
        font-size: .78rem;
        font-weight: 600;
        color: #a08ab0;
        text-align: right;
        margin-bottom: .3rem;
        position: relative;
        z-index: 2;
    }

    .progress-bar {
        background: #EAD9F5;
        border-radius: 99px;
        height: 8px;
        overflow: hidden;
        margin-bottom: 1.4rem;
        position: relative;
        z-index: 2;
    }

    .progress-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, #C4A9E0, #F4A7B9);
        transition: width .4s ease;
    }

    /* ── Kartu soal ── */
    .question-card {
        background: #C8E6C9;
        border-radius: 22px;
        padding: 1.4rem 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 2;
    }

    .question-text {
        font-size: 1.1rem;
        font-weight: 800;
        color: #3a4a3a;
        line-height: 1.5;
        margin: 0;
    }

    /* ── Pilihan jawaban ── */
    .choices {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .7rem;
        position: relative;
        z-index: 2;
    }

    .choice-label {
        background: #f3eeff;
        border: 2px solid transparent;
        border-radius: 50px;
        padding: .75rem 1rem;
        font-size: .88rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: .7rem;
        color: #4a3a5a;
        transition: border-color .2s, background .2s, transform .15s;
        font-family: 'Nunito', sans-serif;
    }

    .choice-label:hover {
        border-color: #C4A9E0;
        background: #ede4fd;
        transform: translateY(-1px);
    }

    .choice-label input[type=radio] { display: none; }

    .choice-label:has(input:checked) {
        border-color: #A07BC0;
        background: #F0E5FC;
        color: #6a3a9a;
    }

    /* Badge huruf dengan border lingkaran */
    .choice-badge {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #C4A9E0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .8rem;
        font-weight: 800;
        color: #7a5a9a;
        flex-shrink: 0;
        transition: background .2s, color .2s, border-color .2s;
    }

    .choice-label:has(input:checked) .choice-badge {
        background: #A07BC0;
        border-color: #A07BC0;
        color: white;
    }

    /* ── Tombol lanjut ── */
    .btn-next {
        margin-top: 1.3rem;
        width: 100%;
        padding: .9rem;
        border-radius: 50px;
        border: none;
        font-family: 'Nunito', sans-serif;
        font-size: 1rem;
        font-weight: 800;
        position: relative;
        z-index: 2;
        transition: background .3s, color .25s, transform .2s, box-shadow .2s;

        /* Default: disabled look */
        background: #e0d7eb;
        color: #b8aac8;
        cursor: not-allowed;
        box-shadow: none;
    }

    .btn-next.active {
        background: linear-gradient(90deg, #C4A9E0, #F4A7B9);
        color: white;
        cursor: pointer;
        box-shadow: 0 5px 18px rgba(196,169,224,.45);
    }

    .btn-next.active:hover {
        transform: translateY(-2px);
        box-shadow: 0 9px 24px rgba(196,169,224,.55);
    }

    /* ── Dots ── */
    .dots-row {
        display: flex;
        justify-content: center;
        gap: 6px;
        margin-top: 1.2rem;
        position: relative;
        z-index: 2;
    }

    .step-dot {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #D9C5ED;
        display: inline-block;
        transition: width .3s, background .3s;
    }

    .step-dot.active {
        background: #A07BC0;
        width: 22px;
        border-radius: 99px;
    }

    /* ── Header row ── */
    .header-row {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.2rem;
        position: relative;
        z-index: 2;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
    }

    .page-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #3a4a3a;
    }
</style>
@endpush

@section('content')

<div class="blob-bg" aria-hidden="true">
    <span class="b1"></span><span class="b2"></span>
    <span class="b3"></span><span class="b4"></span><span class="b5"></span>
</div>

<div class="header-row">
    <a href="{{ route('ekskul.pilih') }}" class="back-btn">&#8592; Pilih Ekskul</a>
    <div class="page-title">Tes Kemampuan</div>
</div>

<div>
    <div class="progress-label">Pertanyaan {{ $nomor }} dari {{ $totalSoal }}</div>
    <div class="progress-bar">
        <div class="progress-fill" data-progress="{{ $progress ?? 0 }}"></div>
    </div>
</div>

<form method="POST" action="{{ route('ekskul.simpan-jawaban') }}" id="kuis-form">
    @csrf
    <input type="hidden" name="nomor_soal" value="{{ $nomor - 1 }}">

    <div class="question-card">
        <p class="question-text">{{ $soal['pertanyaan'] }}</p>
    </div>

    <div class="choices">
        @php $letters = ['A','B','C','D','E']; @endphp
        @foreach ($soal['pilihan'] as $idx => $pilihan)
            <label class="choice-label">
                <input type="radio" name="jawaban" value="{{ $idx }}" required>
                <span class="choice-badge">{{ $letters[$idx] ?? $idx+1 }}</span>
                {{ $pilihan }}
            </label>
        @endforeach
    </div>

    <button
        type="submit"
        class="btn-next"
        id="btn-next"
        disabled
    >
        {{ $nomor < $totalSoal ? 'Lanjut →' : 'Selesai ✓' }}
    </button>
</form>

<div class="dots-row">
    @for ($i = 1; $i <= $totalSoal; $i++)
        <span class="step-dot {{ $i === $nomor ? 'active' : '' }}"></span>
    @endfor
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set progress bar width dari data attribute
        document.querySelectorAll('.progress-fill').forEach(function(el) {
            var p = el.getAttribute('data-progress') || 0;
            el.style.width = p + '%';
        });

        // Aktifkan tombol setelah jawaban dipilih
        document.querySelectorAll('input[type=radio]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var btn = document.getElementById('btn-next');
                btn.disabled = false;
                btn.classList.add('active');
            });
        });
    });
</script>
@endpush