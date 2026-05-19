@extends('layouts.app')

@section('title', 'Kuis Kemampuan')

@push('styles')
<style>
    .progress-bar {
        background: #E5E7EB;
        border-radius: 99px;
        height: 8px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--purple), var(--pink));
        transition: width .4s ease;
    }

    .progress-label {
        font-size: .8rem;
        color: var(--text-muted);
        text-align: right;
        margin-bottom: .3rem;
    }

    .question-text {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .choices {
        display: flex;
        flex-direction: column;
        gap: .6rem;
    }

    .choice-label {
        background: #F9FAFB;
        border: 1.5px solid #E5E7EB;
        border-radius: var(--radius-sm);
        padding: .7rem 1rem;
        font-size: .9rem;
        cursor: pointer;
        transition: all .2s;
        font-family: 'Nunito', sans-serif;
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .choice-label:hover {
        border-color: var(--purple);
        background: var(--purple-light);
    }

    .choice-label input[type=radio] {
        accent-color: var(--purple-dark);
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .choice-label:has(input:checked) {
        border-color: var(--purple-dark);
        background: var(--purple-light);
        color: var(--purple-dark);
        font-weight: 700;
    }
</style>
@endpush

@section('content')

<div class="header-row">
    <a href="{{ route('ekskul.pilih') }}" class="back-btn">←</a>
    <div class="page-title">Tes Kemampuan</div>
</div>

<div>
    <div class="progress-label">
        Pertanyaan {{ $nomor }} dari {{ $totalSoal }}
    </div>

    <div class="progress-bar">
        <div class="progress-fill" data-progress="{{ $progress ?? 0 }}"></div>
    </div>
</div>

<form method="POST" action="{{ route('ekskul.simpan-jawaban') }}" id="kuis-form">
    @csrf

    <input type="hidden" name="nomor_soal" value="{{ $nomor - 1 }}">

    <div class="card">
        <div class="question-text">
            {{ $soal['pertanyaan'] }}
        </div>

        <div class="choices">
            @foreach ($soal['pilihan'] as $idx => $pilihan)
                <label class="choice-label">
                    <input 
                        type="radio" 
                        name="jawaban" 
                        value="{{ $idx }}" 
                        required
                    >

                    {{ $pilihan }}
                </label>
            @endforeach
        </div>
    </div>

    <button 
        type="submit" 
        class="btn btn-secondary" 
        id="btn-next" 
        style="display:none"
    >
        {{ $nomor < $totalSoal ? 'Lanjut →' : 'Selesai ✓' }}
    </button>
</form>

<div class="dots-row">
    <span class="step-dot"></span>
    <span class="step-dot active"></span>
    <span class="step-dot"></span>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set progress bar width from data attribute to avoid inline Blade/CSS parsing issues
        document.querySelectorAll('.progress-fill').forEach(function(el) {
            var p = el.getAttribute('data-progress') || 0;
            el.style.width = p + '%';
        });

        document.querySelectorAll('input[type=radio]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('btn-next').style.display = 'block';
            });
        });
    });
</script>
@endpush