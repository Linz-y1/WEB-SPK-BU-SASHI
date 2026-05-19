@extends('admin.app')

@section('admin-content')
    <h2 class="card-title">Pendaftaran Siswa</h2>

    <table style="width:100%;border-collapse:collapse;margin-top:1rem">
        <thead>
            <tr>
                <th style="text-align:left;padding:.5rem">Nama</th>
                <th style="text-align:left;padding:.5rem">Nomor</th>
                <th style="text-align:left;padding:.5rem">Ekskul</th>
                <th style="text-align:left;padding:.5rem">Status</th>
                <th style="text-align:left;padding:.5rem">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $it)
            <tr style="border-top:1px solid #eee">
                <td style="padding:.5rem">{{ $it->nama }}</td>
                <td style="padding:.5rem">{{ $it->nomor_siswa }}</td>
                <td style="padding:.5rem">{{ $it->ekskul_nama }}</td>
                <td style="padding:.5rem">{{ $it->status }}</td>
                <td style="padding:.5rem">
                    @if($it->status === 'pending')
                        <form method="POST" action="{{ route('admin.siswa.approve', $it->pivot_id) }}" style="display:inline">@csrf<button class="btn btn-success" style="padding:.4rem .6rem">Approve</button></form>
                        <form method="POST" action="{{ route('admin.siswa.reject', $it->pivot_id) }}" style="display:inline;margin-left:.5rem">@csrf<button class="btn" style="background:#FEE2E2;color:#991B1B;padding:.4rem .6rem">Reject</button></form>
                    @else
                        —
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
