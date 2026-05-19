@extends('admin.layouts.app')

@section('title', 'Tambah Soal Kuis')
@section('page-title', 'Tambah Soal Kuis')
@section('page-subtitle', 'Buat soal kuis baru untuk siswa.')

@section('content')
<div style="max-width:760px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.kuis.index') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Tambah Soal Kuis</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.kuis.store') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Urutan Soal</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Pertanyaan</label>
                    <textarea name="pertanyaan" class="form-control" rows="3" required>{{ old('pertanyaan') }}</textarea>
                </div>

                @for($i = 0; $i < 4; $i++)
                <div class="form-group">
                    <label class="form-label">Pilihan {{ $i + 1 }}</label>
                    <input type="text" name="pilihan[{{ $i }}]" class="form-control" value="{{ old('pilihan.' . $i) }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mapping Jawaban {{ $i + 1 }} (slug ekskul)</label>
                    <input type="text" name="jawaban_map[{{ $i }}]" class="form-control" value="{{ old('jawaban_map.' . $i) }}" placeholder="contoh: musik" required>
                </div>
                @endfor

                <div style="display:flex;gap:12px;margin-top:24px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                        <i class="fa-solid fa-plus"></i> Simpan Soal
                    </button>
                    <a href="{{ route('admin.kuis.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
