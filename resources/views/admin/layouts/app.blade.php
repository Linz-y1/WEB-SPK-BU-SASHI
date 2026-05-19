<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') — WEB-ESKUL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --pink-50:  #fff0f3;
            --pink-100: #ffe0e8;
            --pink-200: #ffb3c6;
            --pink-300: #ff85a1;
            --pink-400: #f4587a;
            --green-100: #d4f4d4;
            --green-200: #a8e6a8;
            --green-300: #6dcf6d;
            --green-400: #4caf50;
            --cream:    #fdf6ec;
            --white:    #ffffff;
            --text-dark:#2d2d2d;
            --text-mid: #666;
            --shadow-soft: 0 4px 20px rgba(244,88,122,.12);
            --shadow-card: 0 8px 30px rgba(0,0,0,.07);
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 10px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
        }

        body::before {
            content: '';
            position: fixed;
            top: -120px; left: -120px;
            width: 380px; height: 380px;
            background: radial-gradient(circle, var(--pink-100) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -100px; right: -100px;
            width: 320px; height: 320px;
            background: radial-gradient(circle, var(--green-100) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--pink-100);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(244,88,122,.07);
            transition: transform .3s ease;
        }

        .sidebar-brand {
            padding: 28px 24px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--pink-100);
        }
        .sidebar-brand .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--pink-300), var(--pink-400));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: white;
            box-shadow: 0 4px 12px rgba(244,88,122,.35);
        }
        .sidebar-brand .brand-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 18px;
            color: var(--text-dark);
            line-height: 1.1;
        }
        .sidebar-brand .brand-text span {
            display: block;
            font-size: 11px;
            font-weight: 500;
            color: var(--text-mid);
            letter-spacing: .5px;
        }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #bbb;
            padding: 14px 12px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: var(--radius-sm);
            color: var(--text-mid);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all .2s ease;
            margin-bottom: 2px;
            position: relative;
        }
        .nav-item:hover {
            background: var(--pink-50);
            color: var(--pink-400);
        }
        .nav-item.active {
            background: linear-gradient(135deg, var(--pink-50), var(--pink-100));
            color: var(--pink-400);
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: var(--pink-400);
            border-radius: 0 4px 4px 0;
        }
        .nav-item .nav-icon {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: var(--pink-50);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            transition: background .2s;
        }
        .nav-item.active .nav-icon,
        .nav-item:hover  .nav-icon { background: var(--pink-100); }

        .sidebar-footer {
            padding: 16px 12px 24px;
            border-top: 1px solid var(--pink-100);
        }
        .sidebar-footer .nav-item { color: #e57373; }
        .sidebar-footer .nav-item:hover { background: #fff5f5; }
        .sidebar-footer .nav-icon { background: #fff5f5; }

        .main-wrap {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .topbar {
            height: 68px;
            background: rgba(255,255,255,.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--pink-100);
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
            position: sticky; top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 20px;
            color: var(--text-dark);
            flex: 1;
        }
        .topbar-title small {
            display: block;
            font-size: 12px;
            font-weight: 400;
            color: var(--text-mid);
            font-family: 'Nunito', sans-serif;
        }

        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--pink-50);
            border: 1.5px solid var(--pink-100);
            border-radius: 50px;
            padding: 8px 16px;
            transition: border-color .2s;
        }
        .topbar-search:focus-within { border-color: var(--pink-300); }
        .topbar-search input {
            border: none;
            background: none;
            font-family: 'Nunito', sans-serif;
            font-size: 13px;
            color: var(--text-dark);
            outline: none;
            width: 180px;
        }
        .topbar-search i { color: var(--pink-300); font-size: 13px; }

        .topbar-avatar {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--pink-300), var(--green-300));
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 15px;
            cursor: pointer;
            box-shadow: 0 3px 10px rgba(244,88,122,.3);
        }
        .topbar-notif {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: var(--pink-50);
            border: 1.5px solid var(--pink-100);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: var(--pink-400);
            position: relative;
            transition: background .2s;
        }
        .topbar-notif:hover { background: var(--pink-100); }
        .notif-dot {
            position: absolute; top: 6px; right: 6px;
            width: 8px; height: 8px;
            background: var(--pink-400);
            border-radius: 50%;
            border: 2px solid white;
        }

        .page-content {
            flex: 1;
            padding: 28px;
        }

        .card {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            border: 1px solid var(--pink-50);
            overflow: hidden;
        }
        .card-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--pink-50);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700; font-size: 16px;
        }
        .card-body { padding: 24px; }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }
        .stat-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 22px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--pink-50);
            display: flex; align-items: center; gap: 16px;
            transition: transform .2s, box-shadow .2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0,0,0,.09);
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .stat-icon.pink  { background: var(--pink-100);  color: var(--pink-400); }
        .stat-icon.green { background: var(--green-100); color: var(--green-400); }
        .stat-icon.peach { background: #ffe8d6; color: #e07b39; }
        .stat-icon.sky   { background: #d4f0fc; color: #2196f3; }

        .stat-info .stat-value {
            font-family: 'Poppins', sans-serif;
            font-weight: 700; font-size: 26px;
            line-height: 1;
        }
        .stat-info .stat-label {
            font-size: 12px; color: var(--text-mid); margin-top: 4px;
        }
        .stat-info .stat-badge {
            display: inline-block;
            margin-top: 6px; padding: 2px 8px;
            border-radius: 50px; font-size: 11px; font-weight: 600;
            background: var(--green-100); color: var(--green-400);
        }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 700;
            letter-spacing: .8px; text-transform: uppercase;
            color: var(--text-mid);
            background: var(--pink-50);
            border-bottom: 2px solid var(--pink-100);
        }
        tbody tr {
            border-bottom: 1px solid var(--pink-50);
            transition: background .15s;
        }
        tbody tr:hover { background: var(--pink-50); }
        tbody td { padding: 14px 16px; font-size: 14px; }

        .badge {
            display: inline-flex; align-items: center;
            padding: 4px 12px; border-radius: 50px;
            font-size: 11px; font-weight: 700;
        }
        .badge-pink  { background: var(--pink-100);  color: var(--pink-400); }
        .badge-green { background: var(--green-100); color: var(--green-400); }
        .badge-gray  { background: #f0f0f0; color: #888; }

        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700; font-size: 13px;
            border: none; cursor: pointer;
            text-decoration: none;
            transition: all .2s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--pink-300), var(--pink-400));
            color: white;
            box-shadow: 0 4px 14px rgba(244,88,122,.35);
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(244,88,122,.45);
        }
        .btn-green {
            background: linear-gradient(135deg, var(--green-300), var(--green-400));
            color: white;
            box-shadow: 0 4px 14px rgba(76,175,80,.3);
        }
        .btn-outline {
            background: var(--white);
            color: var(--pink-400);
            border: 1.5px solid var(--pink-200);
        }
        .btn-outline:hover { background: var(--pink-50); }
        .btn-sm { padding: 7px 14px; font-size: 12px; }
        .btn-icon { padding: 8px 10px; border-radius: 10px; }

        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block; font-size: 13px;
            font-weight: 700; color: var(--text-dark);
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid var(--pink-100);
            border-radius: var(--radius-sm);
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            color: var(--text-dark);
            background: var(--white);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--pink-300);
            box-shadow: 0 0 0 3px rgba(244,88,122,.08);
        }

        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: var(--green-100); color: #2e7d32; border-left: 4px solid var(--green-400); }
        .alert-error   { background: var(--pink-100);  color: #c62828; border-left: 4px solid var(--pink-400); }

        .sidebar-toggle {
            display: none;
            background: none; border: none; cursor: pointer;
            font-size: 20px; color: var(--pink-400);
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-260px); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .sidebar-toggle { display: block; }
            .topbar-search { display: none; }
        }

        .page-content > .dots-decor {
            position: fixed;
            top: 80px; right: 30px;
            width: 80px; height: 80px;
            background-image: radial-gradient(var(--pink-200) 1.5px, transparent 1.5px);
            background-size: 12px 12px;
            opacity: .5;
            pointer-events: none;
        }
    </style>
    @stack('styles')
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="fa-solid fa-school-flag"></i></div>
            <div class="brand-text">
                WEB-ESKUL
                <span>Admin Panel</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Utama</div>

            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-house"></i></span>
                Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>

            <a href="{{ route('admin.siswa.index') }}" class="nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user-graduate"></i></span>
                Data Siswa
            </a>

            <a href="{{ route('admin.ekskul.index') }}" class="nav-item {{ request()->routeIs('admin.ekskul.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-star"></i></span>
                Ekstrakurikuler
            </a>

            <a href="{{ route('admin.kuis.index') }}" class="nav-item {{ request()->routeIs('admin.kuis.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-clipboard-question"></i></span>
                Kuis Minat
            </a>

            <a href="{{ route('admin.hasil.index') }}" class="nav-item {{ request()->routeIs('admin.hasil.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-chart-bar"></i></span>
                Hasil Rekomendasi
            </a>

        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item" style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">
                    <span class="nav-icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrap">
        <header class="topbar">
            <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="topbar-title">
                @yield('page-title', 'Dashboard')
                <small>@yield('page-subtitle', 'Selamat datang kembali!')</small>
            </div>

            <div class="topbar-avatar" title="{{ Auth::user()->name ?? 'Admin' }}">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
        </header>

        <main class="page-content">
            <div class="dots-decor"></div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-xmark"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
