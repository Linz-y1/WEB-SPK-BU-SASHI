@extends('admin.layouts.app')

@section('title', 'Hasil Rekomendasi')
@section('page-title', 'Hasil Rekomendasi')
@section('page-subtitle', 'Ringkasan hasil rekomendasi ektrakurikuler siswa.')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Hasil Rekomendasi</h3>
    </div>
    <div class="card-body">
        <p>Total hasil rekomendasi: <strong>{{ $totalRekomendasi }}</strong></p>
        <p>Halaman ini akan menampilkan daftar rekomendasi siswa berdasarkan hasil kuis.</p>
    </div>
</div>

@endsection
