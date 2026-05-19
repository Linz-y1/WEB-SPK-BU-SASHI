@extends('admin.app')

@section('admin-content')
    <h2 class="card-title">Dashboard</h2>
    <div style="display:flex;gap:1rem;margin-top:1rem">
        <div class="card" style="flex:1">Total Ekskul: <strong>{{ $totalEkskul }}</strong></div>
        <div class="card" style="flex:1">Total Siswa: <strong>{{ $totalSiswa }}</strong></div>
        <div class="card" style="flex:1">Pendaftaran Pending: <strong>{{ $pendaftaranPending }}</strong></div>
    </div>
@endsection
