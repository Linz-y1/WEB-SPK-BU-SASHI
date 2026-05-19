@extends('admin.layouts.app')

@section('title', isset($ekskul) ? 'Edit Ekskul' : 'Tambah Ekskul')
@section('page-title', isset($ekskul) ? 'Edit Ekskul' : 'Tambah Ekskul')
@section('page-subtitle', isset($ekskul) ? 'Perbarui data ekstrakurikuler' : 'Tambah ekstrakurikuler baru')

@section('content')

<div style="max-width:640px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.ekskul.index') }}" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>{{ isset($ekskul) ? 'Edit' : 'Form' }} Ekstrakurikuler</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($ekskul) ? route('admin.ekskul.update', $ekskul->id) : route('admin.ekskul.store') }}">
                @csrf
                @if(isset($ekskul)) @method('PUT') @endif

                @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <div>
                        @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Nama Ekstrakurikuler <span style="color:var(--pink-400);">*</span></label>
                    <input type="text" name="nama" class="form-control"
                        value="{{ old('nama', $ekskul->nama ?? '') }}"
                        placeholder="Contoh: Basket, Musik, Pramuka..." required>
                </div>

                <div class="form-group">
                    <label class="form-label">Slug URL <span style="color:var(--pink-400);">*</span></label>
                    <input type="text" name="slug" class="form-control"
                        value="{{ old('slug', $ekskul->slug ?? '') }}"
                        placeholder="contoh-basket" required>
                    <small style="color:var(--text-mid);">Gunakan huruf kecil tanpa spasi; akan digunakan untuk URL.</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Ikon (emoji)</label>
                    <input type="text" name="icon" class="form-control"
                        value="{{ old('icon', $ekskul->icon ?? '') }}"
                        placeholder="🎯 (opsional, masukkan emoji)">
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"
                        placeholder="Deskripsi singkat tentang ekstrakurikuler ini...">{{ old('deskripsi', $ekskul->deskripsi ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Kuota Anggota</label>
                    <input type="number" name="quota" class="form-control"
                        value="{{ old('quota', $ekskul->quota ?? '') }}"
                        placeholder="Kosongkan jika tidak dibatasi" min="1">
                </div>

                <div style="display:flex;gap:12px;margin-top:24px;">
                    <button type="submit" class="btn btn-primary" style="flex:1;justify-content:center;">
                        <i class="fa-solid fa-{{ isset($ekskul) ? 'floppy-disk' : 'plus' }}"></i>
                        {{ isset($ekskul) ? 'Simpan Perubahan' : 'Tambah Ekskul' }}
                    </button>
                    <a href="{{ route('admin.ekskul.index') }}" class="btn btn-outline" style="flex:1;justify-content:center;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection