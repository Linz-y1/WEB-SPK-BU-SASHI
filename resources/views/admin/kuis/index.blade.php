@extends('admin.layouts.app')

@section('title', 'Kuis Minat')
@section('page-title', 'Kuis Minat')
@section('page-subtitle', 'Kelola soal kuis minat.')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:20px;">
    <div>
        <h2 class="card-title">Kuis Minat</h2>
        <p>Kelola daftar soal kuis dan mapping jawaban.</p>
    </div>
    <a href="{{ route('admin.kuis.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Soal
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Pertanyaan</th>
                        <th>Jumlah Pilihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kuisSoals as $soal)
                    <tr>
                        <td>{{ $soal->order }}</td>
                        <td>{{ Str::limit($soal->pertanyaan, 80) }}</td>
                        <td>{{ count($soal->pilihan) }}</td>
                        <td style="display:flex;gap:8px;flex-wrap:wrap;">
                            <a href="{{ route('admin.kuis.edit', $soal->id) }}" class="btn btn-sm btn-outline">Edit</a>
                            <form action="{{ route('admin.kuis.destroy', $soal->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline" onclick="return confirm('Hapus soal kuis ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:50px;color:#bbb;">
                            <i class="fa-solid fa-clipboard-question" style="font-size:32px;display:block;margin-bottom:10px;opacity:.4;"></i>
                            Belum ada soal kuis.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kuisSoals->hasPages())
        <div style="padding:16px 20px;border-top:1px solid var(--pink-50);">
            {{ $kuisSoals->links() }}
        </div>
        @endif
    </div>
</div>

@endsection
