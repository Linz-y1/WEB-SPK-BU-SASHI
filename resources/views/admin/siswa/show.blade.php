@extends('admin.layouts.app')

@section('title', 'Detail Siswa')
@section('page-title', 'Detail Siswa')
@section('page-subtitle', 'Rincian siswa dan informasi pendaftaran.')

@section('content')

<div class="card">
    <div class="card-header">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;">
            <div>
                <h3>{{ $siswa->name }}</h3>
                <p style="color:var(--text-mid);margin-top:6px;">Detail lengkap siswa dan hasil rekomendasi.</p>
            </div>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline btn-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <div>{{ $siswa->name }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <div>{{ $siswa->email }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Nomor Siswa</label>
                <div>{{ $siswa->nomor_siswa }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Kelas</label>
                <div>{{ $siswa->kelas }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Jurusan</label>
                <div>{{ $siswa->jurusan ?? '-' }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <div>{{ $siswa->jenis_kelamin ?? '-' }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Status Pendaftaran</label>
                <div>
                    @if($siswa->status_pendaftaran === 'pending')
                        <span class="badge badge-gray">Menunggu</span>
                    @elseif($siswa->status_pendaftaran === 'approved')
                        <span class="badge badge-green">Disetujui</span>
                    @elseif($siswa->status_pendaftaran === 'rejected')
                        <span class="badge badge-pink">Ditolak</span>
                    @else
                        <span class="badge badge-gray">-</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Rekomendasi Ekskul</label>
                <div>{{ $siswa->hasilRekomendasi->rekomendasi_ekskul ?? '-' }}</div>
            </div>
        </div>

        <div style="margin-top:24px;">
            <h4>Ekskul Terdaftar</h4>
            @if($siswa->ekskuls->count())
                <ul style="padding-left:18px;"> 
                    @foreach($siswa->ekskuls as $ekskul)
                        <li>{{ $ekskul->nama }} {{ $ekskul->icon ? '('.$ekskul->icon.')' : '' }}</li>
                    @endforeach
                </ul>
            @else
                <div style="color:var(--text-mid);">Belum ada ekskul terdaftar.</div>
            @endif
        </div>
    </div>
</div>

@endsection
