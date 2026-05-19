@extends('admin.app')

@section('admin-content')
    <h2 class="card-title">Kelola Ekskul</h2>
    <a href="{{ route('admin.ekskul.create') }}" class="btn btn-primary" style="display:inline-block;margin-top:1rem;padding:.5rem 1rem">Buat Ekskul</a>

    <table style="width:100%;border-collapse:collapse;margin-top:1rem">
        <thead>
            <tr>
                <th style="text-align:left;padding:.5rem">Nama</th>
                <th style="text-align:left;padding:.5rem">Slug</th>
                <th style="text-align:left;padding:.5rem">Kuota</th>
                <th style="text-align:left;padding:.5rem">Terpakai</th>
                <th style="text-align:left;padding:.5rem">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ekskuls as $e)
            <tr style="border-top:1px solid #eee">
                <td style="padding:.5rem">{{ $e->nama }}</td>
                <td style="padding:.5rem">{{ $e->slug }}</td>
                <td style="padding:.5rem">{{ $e->quota }}</td>
                <td style="padding:.5rem">{{ $e->approved_count }}</td>
                <td style="padding:.5rem">
                    <a href="{{ route('admin.ekskul.edit', $e->id) }}" class="btn btn-secondary" style="padding:.35rem .6rem">Edit</a>
                    <form method="POST" action="{{ route('admin.ekskul.destroy', $e->id) }}" style="display:inline">@csrf @method('DELETE')<button class="btn" style="background:#FEE2E2;color:#991B1B;padding:.35rem .6rem;margin-left:.5rem">Hapus</button></form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection
