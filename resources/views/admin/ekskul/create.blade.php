@extends('admin.app')

@section('admin-content')
    <h2 class="card-title">Buat Ekskul</h2>

    <form method="POST" action="{{ route('admin.ekskul.store') }}" style="margin-top:1rem">
        @csrf
        <div style="margin-bottom:.75rem">
            <label>Nama</label>
            <input type="text" name="nama" required />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Slug</label>
            <input type="text" name="slug" required />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Icon</label>
            <input type="text" name="icon" />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Kuota (0 = tanpa batas)</label>
            <input type="number" name="quota" min="0" value="0" />
        </div>
        <div style="margin-bottom:.75rem">
            <label>Deskripsi</label>
            <textarea name="deskripsi"></textarea>
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>

@endsection
