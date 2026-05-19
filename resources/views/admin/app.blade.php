@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div style="display:flex;gap:1.5rem;">
    <aside style="width:220px;">
        <div class="card">
            <div style="font-weight:800;margin-bottom:.5rem">Admin</div>
            <nav style="display:flex;flex-direction:column;gap:.5rem">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.siswa.index') }}">Pendaftaran Siswa</a>
                <a href="{{ route('admin.ekskul.index') }}">Kelola Ekskul</a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="btn" style="margin-top:.75rem">Logout</button></form>
            </nav>
        </div>
    </aside>

    <main style="flex:1">
        <div class="card">
            @if(session('success'))
                <div style="margin-bottom:1rem;color:green">{{ session('success') }}</div>
            @endif

            @yield('admin-content')
        </div>
    </main>
</div>
@endsection
