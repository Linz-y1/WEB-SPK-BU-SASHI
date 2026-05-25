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

        :root{
            --pink-50:#fff0f3;
            --pink-100:#ffe0e8;
            --pink-200:#ffb3c6;
            --pink-300:#ff85a1;
            --pink-400:#f4587a;

            --green-100:#d4f4d4;
            --green-200:#a8e6a8;
            --green-300:#6dcf6d;
            --green-400:#4caf50;

            --cream:#fdf6ec;
            --white:#ffffff;

            --text-dark:#2d2d2d;
            --text-mid:#666;

            --shadow-card:0 8px 30px rgba(0,0,0,.07);

            --radius-lg:20px;
            --radius-md:14px;
            --radius-sm:10px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Nunito',sans-serif;
            background:var(--cream);
            color:var(--text-dark);
            min-height:100vh;
            display:flex;
        }

        body::before{
            content:'';
            position:fixed;
            top:-120px;
            left:-120px;
            width:380px;
            height:380px;
            background:radial-gradient(circle,var(--pink-100) 0%,transparent 70%);
            border-radius:50%;
            pointer-events:none;
            z-index:0;
        }

        body::after{
            content:'';
            position:fixed;
            bottom:-100px;
            right:-100px;
            width:320px;
            height:320px;
            background:radial-gradient(circle,var(--green-100) 0%,transparent 70%);
            border-radius:50%;
            pointer-events:none;
            z-index:0;
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar{
            width:260px;
            min-height:100vh;
            background:var(--white);
            border-right:1px solid var(--pink-100);

            display:flex;
            flex-direction:column;

            position:fixed;
            top:0;
            left:0;
            bottom:0;

            z-index:100;

            overflow:hidden;

            box-shadow:4px 0 24px rgba(244,88,122,.07);
            transition:transform .3s ease;
        }

        .sidebar-brand,
        .sidebar-nav,
        .sidebar-footer{
            position:relative;
            z-index:2;
        }

        .sidebar-brand{
            padding:28px 24px 20px;
            display:flex;
            align-items:center;
            gap:12px;
            border-bottom:1px solid var(--pink-100);
        }

        .brand-icon{
            width:42px;
            height:42px;
            background:linear-gradient(135deg,var(--pink-300),var(--pink-400));
            border-radius:12px;

            display:flex;
            align-items:center;
            justify-content:center;

            color:white;
            font-size:18px;
        }

        .brand-text{
            font-family:'Poppins',sans-serif;
            font-weight:700;
            font-size:18px;
            line-height:1.1;
        }

        .brand-text span{
            display:block;
            font-size:11px;
            color:var(--text-mid);
            font-weight:500;
        }

        .admin-online-badge{
            display:inline-flex;
            align-items:center;
            gap:5px;

            background:linear-gradient(135deg,var(--pink-50),var(--green-100));

            border:1px solid var(--pink-200);

            border-radius:50px;

            padding:3px 10px 3px 7px;

            font-size:10px;
            font-weight:700;

            color:var(--pink-400);

            margin-top:4px;
        }

        .pulse-dot{
            width:7px;
            height:7px;
            border-radius:50%;
            background:var(--green-400);
        }

        .sidebar-nav{
            flex:1;
            padding:16px 12px;
            overflow-y:auto;
        }

        .nav-section-label{
            font-size:10px;
            font-weight:700;
            letter-spacing:1.2px;
            text-transform:uppercase;
            color:#bbb;
            padding:14px 12px 6px;
        }

        .nav-item{
            display:flex;
            align-items:center;
            gap:12px;

            padding:11px 14px;

            border-radius:var(--radius-sm);

            color:var(--text-mid);
            text-decoration:none;

            font-weight:600;
            font-size:14px;

            transition:all .2s ease;

            margin-bottom:2px;

            position:relative;
        }

        .nav-item:hover{
            background:var(--pink-50);
            color:var(--pink-400);
        }

        .nav-item.active{
            background:linear-gradient(135deg,var(--pink-50),var(--pink-100));
            color:var(--pink-400);
        }

        .nav-item.active::before{
            content:'';
            position:absolute;
            left:0;
            top:50%;
            transform:translateY(-50%);
            width:3px;
            height:60%;
            background:var(--pink-400);
        }

        .nav-icon{
            width:34px;
            height:34px;

            border-radius:9px;

            background:var(--pink-50);

            display:flex;
            align-items:center;
            justify-content:center;
        }

        .nav-item:hover .nav-icon,
        .nav-item.active .nav-icon{
            background:var(--pink-100);
        }

        .sidebar-footer{
            padding:16px 12px 24px;
            border-top:1px solid var(--pink-100);
        }

        /* =========================================================
           BUBBLE DECORATION
        ========================================================= */

        .bubble{
            position:absolute;
            border-radius:50%;
            pointer-events:none;
            z-index:0;
        }

        .bubble-1{
            width:90px;
            height:90px;
            background:radial-gradient(circle at 35% 35%, #ffd6e2, #ffb3c6 60%, transparent 80%);
            top:-30px;
            right:-20px;
            opacity:.55;
        }

        .bubble-2{
            width:55px;
            height:55px;
            background:radial-gradient(circle at 35% 35%, #d4f4d4, #a8e6a8 60%, transparent 80%);
            top:60px;
            right:10px;
            opacity:.45;
        }

        .bubble-3{
            width:38px;
            height:38px;
            background:radial-gradient(circle at 35% 35%, #ffe0e8, #ffb3c6 60%, transparent 80%);
            top:130px;
            left:8px;
            opacity:.38;
        }

        .bubble-4{
            width:70px;
            height:70px;
            background:radial-gradient(circle at 35% 35%, #d4f4d4, #a8e6a8 60%, transparent 80%);
            bottom:130px;
            right:-20px;
            opacity:.42;
        }

        /* =========================================================
           MAIN CONTENT
        ========================================================= */

        .main-wrap{
            margin-left:260px;
            flex:1;
            display:flex;
            flex-direction:column;
            min-height:100vh;
            position:relative;
            z-index:1;
        }

        .topbar{
            height:68px;
            background:rgba(255,255,255,.85);

            backdrop-filter:blur(12px);

            border-bottom:1px solid var(--pink-100);

            display:flex;
            align-items:center;

            padding:0 28px;

            position:sticky;
            top:0;

            z-index:50;
        }

        .topbar-title{
            font-family:'Poppins',sans-serif;
            font-weight:700;
            font-size:20px;
            flex:1;
        }

        .topbar-title small{
            display:block;
            font-size:12px;
            color:var(--text-mid);
            font-family:'Nunito',sans-serif;
            font-weight:400;
        }

        .page-content{
            flex:1;
            padding:28px;
        }

        /* =========================================================
           CARD
        ========================================================= */

        .card{
            background:var(--white);
            border-radius:var(--radius-lg);
            box-shadow:var(--shadow-card);
            border:1px solid var(--pink-50);
            overflow:hidden;
        }

        .card-header{
            padding:20px 24px 16px;

            border-bottom:1px solid var(--pink-50);

            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .card-header h3{
            font-family:'Poppins',sans-serif;
            font-size:16px;
            font-weight:700;
        }

        .card-body{
            padding:24px;
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .table-wrap{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead th{
            padding:12px 16px;

            font-size:11px;
            font-weight:700;
            letter-spacing:.8px;
            text-transform:uppercase;

            color:var(--text-mid);

            background:var(--pink-50);

            border-bottom:2px solid var(--pink-100);
        }

        tbody tr{
            border-bottom:1px solid var(--pink-50);
            transition:background .15s;
        }

        tbody tr:hover{
            background:var(--pink-50);
        }

        tbody td{
            padding:14px 16px;
            font-size:14px;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn{
            display:inline-flex;
            align-items:center;
            gap:8px;

            padding:10px 20px;

            border-radius:50px;

            font-family:'Nunito',sans-serif;
            font-size:13px;
            font-weight:700;

            border:none;
            cursor:pointer;
            text-decoration:none;

            transition:all .2s ease;
        }

        .btn-primary{
            background:linear-gradient(135deg,var(--pink-300),var(--pink-400));
            color:white;
        }

        .btn-primary:hover{
            transform:translateY(-2px);
        }

        .btn-outline{
            background:var(--white);
            color:var(--pink-400);

            border:1.5px solid var(--pink-200);
        }

        /* =========================================================
           FORM
        ========================================================= */

        .form-group{
            margin-bottom:18px;
        }

        .form-label{
            display:block;
            font-size:13px;
            font-weight:700;
            margin-bottom:6px;
        }

        .form-control{
            width:100%;
            padding:11px 16px;

            border:1.5px solid var(--pink-100);
            border-radius:var(--radius-sm);

            font-family:'Nunito',sans-serif;
            font-size:14px;

            outline:none;
        }

        .form-control:focus{
            border-color:var(--pink-300);
            box-shadow:0 0 0 3px rgba(244,88,122,.08);
        }

        /* =========================================================
           ALERT
        ========================================================= */

        .alert{
            padding:14px 18px;
            border-radius:var(--radius-sm);
            font-size:14px;
            margin-bottom:20px;

            display:flex;
            align-items:center;
            gap:10px;
        }

        .alert-success{
            background:var(--green-100);
            color:#2e7d32;
            border-left:4px solid var(--green-400);
        }

        .alert-error{
            background:var(--pink-100);
            color:#c62828;
            border-left:4px solid var(--pink-400);
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        .sidebar-toggle{
            display:none;
            background:none;
            border:none;
            font-size:20px;
            color:var(--pink-400);
            cursor:pointer;
        }

        @media(max-width:768px){

            .sidebar{
                transform:translateX(-260px);
            }

            .sidebar.open{
                transform:translateX(0);
            }

            .main-wrap{
                margin-left:0;
            }

            .sidebar-toggle{
                display:block;
            }
        }

    </style>

    @stack('styles')

</head>

<body>

    <aside class="sidebar" id="sidebar">

        {{-- Bubble Decoration --}}
        <div class="bubble bubble-1"></div>
        <div class="bubble bubble-2"></div>
        <div class="bubble bubble-3"></div>
        <div class="bubble bubble-4"></div>

        {{-- Brand --}}
        <div class="sidebar-brand">

            <div class="brand-icon">
                <i class="fa-solid fa-school-flag"></i>
            </div>

            <div class="brand-text">
                WEB-ESKUL
                <span>Admin Panel</span>

                <div class="admin-online-badge">
                    <span class="pulse-dot"></span>
                    Admin
                </div>
            </div>

        </div>

        {{-- Navigation --}}
        <nav class="sidebar-nav">

            <div class="nav-section-label">Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fa-solid fa-house"></i>
                </span>

                Dashboard
            </a>

            <div class="nav-section-label">Manajemen</div>

            <a href="{{ route('admin.siswa.index') }}"
               class="nav-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </span>

                Data Siswa
            </a>

            <a href="{{ route('admin.ekskul.index') }}"
               class="nav-item {{ request()->routeIs('admin.ekskul.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fa-solid fa-star"></i>
                </span>

                Ekstrakurikuler
            </a>

            <a href="{{ route('admin.kuis.index') }}"
               class="nav-item {{ request()->routeIs('admin.kuis.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fa-solid fa-clipboard-question"></i>
                </span>

                Kuis Minat
            </a>

            <a href="{{ route('admin.hasil.index') }}"
               class="nav-item {{ request()->routeIs('admin.hasil.*') ? 'active' : '' }}">

                <span class="nav-icon">
                    <i class="fa-solid fa-chart-bar"></i>
                </span>

                Hasil Rekomendasi
            </a>

        </nav>

        {{-- Footer --}}
        <div class="sidebar-footer">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="nav-item"
                        style="width:100%;background:none;border:none;cursor:pointer;text-align:left;">

                    <span class="nav-icon">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>

                    Keluar
                </button>
            </form>

        </div>

    </aside>

    <div class="main-wrap">

        <header class="topbar">

            <button class="sidebar-toggle"
                    onclick="document.getElementById('sidebar').classList.toggle('open')">

                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="topbar-title">
                @yield('page-title', 'Dashboard')
                <small>@yield('page-subtitle', 'Selamat datang kembali!')</small>
            </div>

        </header>

        <main class="page-content">

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