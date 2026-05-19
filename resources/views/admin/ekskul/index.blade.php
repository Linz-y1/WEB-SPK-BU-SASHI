@extends('admin.layouts.app')

@section('title', 'Data Ekstrakurikuler')
@section('page-title', 'Data Ekstrakurikuler')
@section('page-subtitle', 'Kelola ekstrakurikuler, kuota, dan status pendaftaran.')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:20px;">
    <div>
        <h2 class="card-title">Daftar Ekstrakurikuler</h2>
        <p>Kelola daftar ekstrakurikuler dan kuota anggota setiap ekskul.</p>
    </div>
    <a href="{{ route('admin.ekskul.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Ekskul
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Ekskul</th>
                        <th>Kuota</th>
                        <th>Disetujui</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ekskuls as $ekskul)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span style="font-size:18px;">{{ $ekskul->icon ?? '🎓' }}</span>
                                <div>
                                    <strong>{{ $ekskul->nama }}</strong><br>
                                    <small style="color:var(--text-mid);">{{ \Illuminate\Support\Str::limit($ekskul->deskripsi, 50) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $ekskul->quota ? $ekskul->quota . ' orang' : 'Tanpa batas' }}</td>
                        <td>{{ $ekskul->approved_count ?? 0 }}</td>
                        <td>
                            @if($ekskul->quota && $ekskul->approved_count >= $ekskul->quota)
                                <span class="badge badge-pink">Penuh</span>
                            @else
                                <span class="badge badge-green">Tersedia</span>
                            @endif
                        </td>
                        <td style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ route('admin.ekskul.edit', $ekskul->id) }}" class="btn btn-sm btn-outline">Edit</a>
                            <form method="POST" action="{{ route('admin.ekskul.destroy', $ekskul->id) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline" onclick="return confirm('Hapus ekskul ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:50px;color:#bbb;">
                            <i class="fa-solid fa-star" style="font-size:32px;display:block;margin-bottom:10px;opacity:.4;"></i>
                            Belum ada ekskul terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection