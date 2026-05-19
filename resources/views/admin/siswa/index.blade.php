@extends('admin.layouts.app')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')
@section('page-subtitle', 'Kelola semua data siswa')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Daftar Siswa</h3>
        <span style="font-size:13px;color:var(--text-mid);">{{ $siswas->total() }} siswa</span>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Nomor Siswa</th>
                        <th>Kelas</th>
                        <th>Status Kuis</th>
                        <th>Rekomendasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswas as $siswa)
                    <tr>
                        <td style="color:#bbb;font-size:13px;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#ffb3c6,#f4587a);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:13px;flex-shrink:0;">
                                    {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                </div>
                                <span style="font-weight:600;">{{ $siswa->name }}</span>
                            </div>
                        </td>
                        <td style="color:var(--text-mid);font-size:13px;">{{ $siswa->nomor_siswa }}</td>
                        <td><span class="badge badge-gray">{{ $siswa->kelas ?? '-' }}</span></td>
                        <td>
                            @if($siswa->kuisJawaban->count() > 0)
                                <span class="badge badge-green"><i class="fa-solid fa-check" style="font-size:10px;"></i> Selesai</span>
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
                            <div style="display:flex;gap:8px;flex-wrap:wrap;align-items:center;">
                                <a href="{{ route('admin.siswa.show', $siswa->id) }}" class="btn btn-outline btn-sm btn-icon" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @if($siswa->ekskuls->isNotEmpty())
                                    <div style="display:flex;flex-direction:column;gap:6px;">
                                        @foreach($siswa->ekskuls as $reg)
                                            <div style="display:flex;gap:6px;align-items:center;">
                                                <span style="font-size:12px;color:var(--text-mid);">{{ $reg->nama }}</span>
                                                @if(($reg->pivot->status ?? 'pending') === 'approved')
                                                    <span class="badge badge-green">Disetujui</span>
                                                @elseif(($reg->pivot->status ?? 'pending') === 'rejected')
                                                    <span class="badge badge-gray">Ditolak</span>
                                                @else
                                                    <form method="POST" action="{{ route('admin.siswa.approve', $reg->pivot->id) }}" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-green" title="Setujui">✔</button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.siswa.reject', $reg->pivot->id) }}" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline" title="Tolak">✖</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:50px;color:#bbb;">
                            <i class="fa-solid fa-user-graduate" style="font-size:32px;display:block;margin-bottom:10px;opacity:.4;"></i>
                            Belum ada data siswa
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($siswas->hasPages())
        <div style="padding:16px 20px;border-top:1px solid var(--pink-50);">
            {{ $siswas->links() }}
        </div>
        @endif
    </div>
</div>

@endsection