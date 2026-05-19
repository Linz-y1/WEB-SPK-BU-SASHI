@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data ekstrakurikuler sekolah')

@section('content')

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon pink"><i class="fa-solid fa-user-graduate"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalSiswa ?? 0 }}</div>
            <div class="stat-label">Total Siswa</div>
            <span class="stat-badge">↑ Aktif</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fa-solid fa-star"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalEkskul ?? 0 }}</div>
            <div class="stat-label">Ekstrakurikuler</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon peach"><i class="fa-solid fa-clipboard-question"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalKuis ?? 0 }}</div>
            <div class="stat-label">Kuis Dikerjakan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon sky"><i class="fa-solid fa-chart-bar"></i></div>
        <div class="stat-info">
            <div class="stat-value">{{ $totalRekomendasi ?? 0 }}</div>
            <div class="stat-label">Rekomendasi Terkirim</div>
        </div>
    </div>
</div>

{{-- Content Grid --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

    {{-- Recent Students --}}
    <div class="card" style="grid-column: 1 / -1;">
        <div class="card-header">
            <h3>Siswa Terbaru</h3>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-outline btn-sm">
                Lihat Semua <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        <div class="card-body" style="padding:0;">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Status Kuis</th>
                            <th>Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSiswa ?? [] as $siswa)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#ffb3c6,#f4587a);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;">
                                        {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                    </div>
                                    <span style="font-weight:600;">{{ $siswa->name }}</span>
                                </div>
                            </td>
                            <td><span style="color:#666;font-size:13px;">{{ $siswa->kelas ?? '-' }}</span></td>
                            <td>
                                @if($siswa->kuisJawaban->count() > 0)
                                    <span class="badge badge-green">Sudah</span>
                                @else
                                    <span class="badge badge-gray">Belum</span>
                                @endif
                            </td>
                            <td>
                                @if($siswa->hasilRekomendasi)
                                    <span class="badge badge-pink">{{ $siswa->hasilRekomendasi->rekomendasi_ekskul ?? '-' }}</span>
                                @else
                                    <span style="color:#bbb;font-size:13px;">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-outline btn-sm btn-icon">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:40px;color:#bbb;">
                                <i class="fa-solid fa-inbox" style="font-size:28px;display:block;margin-bottom:8px;"></i>
                                Belum ada data siswa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Ekskul Summary --}}
    <div class="card">
        <div class="card-header">
            <h3>Ekskul Populer</h3>
        </div>
        <div class="card-body">
            @forelse($ekskulPopuler ?? [] as $ekskul)
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                <div style="display:flex;align-items:center;gap:10px;">
                    <div style="width:36px;height:36px;border-radius:10px;background:var(--pink-100);display:flex;align-items:center;justify-content:center;font-size:16px;">
                        {{ $ekskul->icon ?? '🎯' }}
                    </div>
                    <span style="font-weight:600;font-size:14px;">{{ $ekskul->nama }}</span>
                </div>
                <span class="badge badge-pink">{{ $ekskul->total }} siswa</span>
            </div>
            @empty
            <p style="color:#bbb;text-align:center;padding:20px 0;">Belum ada data</p>
            @endforelse
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="card">
        <div class="card-header">
            <h3>Aksi Cepat</h3>
        </div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:12px;">
            <a href="{{ route('admin.ekskul.create') }}" class="btn btn-primary" style="justify-content:center;">
                <i class="fa-solid fa-plus"></i> Tambah Ekskul Baru
            </a>
            <a href="{{ route('admin.siswa.index') }}" class="btn btn-green" style="justify-content:center;">
                <i class="fa-solid fa-users"></i> Kelola Siswa
            </a>
            <a href="#" class="btn btn-outline" style="justify-content:center;">
                <i class="fa-solid fa-download"></i> Export Laporan
            </a>
        </div>
    </div>

</div>

@endsection