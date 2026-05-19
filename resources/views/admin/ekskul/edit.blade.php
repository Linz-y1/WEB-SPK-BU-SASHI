@extends('admin.app')

@section('admin-content')
    <h2 class="card-title">Edit Ekskul</h2>

    <form method="POST" action="{{ route('admin.ekskul.update', $ekskul->id) }}" style="margin-top:1rem">
        @csrf
        @method('PUT')
        <div style="margin-bottom:.75rem">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $ekskul->nama }}" required />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Slug</label>
            <input type="text" name="slug" value="{{ $ekskul->slug }}" required />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Icon</label>
            <input type="text" name="icon" value="{{ $ekskul->icon }}" />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Kuota (0 = tanpa batas)</label>
            <input type="number" name="quota" min="0" value="{{ $ekskul->quota ?? 0 }}" />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Deskripsi</label>
            <textarea name="deskripsi">{{ $ekskul->deskripsi }}</textarea>
        </div>
        <button class="btn btn-primary">Perbarui</button>
    </form>

@endsection
