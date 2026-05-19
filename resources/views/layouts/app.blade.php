<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EkSmart - @yield('title', 'Pendaftaran Ekskul')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Fredoka+One&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --pink: #F472B6; --pink-light: #FDF2F8;
            --purple: #A78BFA; --purple-dark: #7C3AED; --purple-light: #F5F3FF;
            --green-dark: #059669; --blue-dark: #2563EB;
            --text: #1F2937; --text-muted: #6B7280; --text-light: #9CA3AF;
--bg: #FCE8F3; --white: #fff;
        --radius: 16px; --radius-sm: 10px;
        --shadow: 0 15px 60px rgba(15,23,42,0.08);
    }
        body { font-family: 'Nunito', sans-serif; background: radial-gradient(circle at top left, rgba(251,207,232,.6), transparent 22%), radial-gradient(circle at bottom right, rgba(248,113,113,.12), transparent 20%), linear-gradient(180deg, #FFF7FE 0%, #FCE8F3 100%); color: var(--text); min-height: 100vh; }
        .app { width: 100%; max-width: none; margin: 0; padding: 2.75rem 2rem; min-height: 100vh; display: flex; flex-direction: column; gap: 1.5rem; }

        .card { background: var(--white); border-radius: var(--radius); padding: 1.5rem; box-shadow: var(--shadow); }
        .card-title { font-size: 1.05rem; font-weight: 700; color: var(--text); margin-bottom: 1rem; }

        label { font-size: .85rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: .35rem; }
        input[type=text], input[type=password] {
            width: 100%; padding: .7rem 1rem; border: 1.5px solid #E5E7EB;
            border-radius: var(--radius-sm); font-family: 'Nunito', sans-serif;
            font-size: .95rem; color: var(--text); outline: none; transition: border .2s;
        }
        input[type=text]:focus, input[type=password]:focus { border-color: var(--purple); }

        .btn { width: 100%; padding: .85rem; border: none; border-radius: var(--radius-sm); font-family: 'Fredoka One', cursive; font-size: 1.1rem; letter-spacing: .5px; cursor: pointer; transition: transform .15s; text-decoration: none; display: block; text-align: center; }
        .btn:active { transform: scale(.97); }
        .btn-primary { background: linear-gradient(135deg, var(--purple-dark), var(--pink)); color: #fff; }
        .btn-secondary { background: var(--purple-light); color: var(--purple-dark); }
        .btn-success { background: linear-gradient(135deg, var(--green-dark), var(--blue-dark)); color: #fff; }

        .error-msg { background: #FEE2E2; border: 1.5px solid #FCA5A5; border-radius: var(--radius-sm); padding: .6rem 1rem; font-size: .82rem; color: #991B1B; }

        .logo-area { text-align: center; padding: 1rem 0 .5rem; }
        .logo-icon { font-size: 48px; margin-bottom: .25rem; }
        .logo-title { font-family: 'Fredoka One', cursive; font-size: 1.6rem; color: var(--purple-dark); }
        .logo-sub { font-size: .85rem; color: var(--text-muted); }

        .header-row { display: flex; align-items: center; gap: .75rem; padding: .5rem 0; }
        .back-btn { background: none; border: 1.5px solid #E5E7EB; border-radius: 99px; width: 36px; height: 36px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: var(--text); text-decoration: none; flex-shrink: 0; }
        .page-title { font-family: 'Fredoka One', cursive; font-size: 1.1rem; color: var(--purple-dark); }

        .dots-row { text-align: center; padding: .25rem 0; }
        .step-dot { width: 8px; height: 8px; border-radius: 50%; background: #E5E7EB; display: inline-block; margin: 0 3px; }
        .step-dot.active { background: var(--purple-dark); }

        .tag-nama { background: linear-gradient(135deg, var(--purple-light), var(--pink-light)); border-radius: var(--radius-sm); padding: .5rem 1rem; font-size: .85rem; color: var(--purple-dark); font-weight: 700; text-align: center; }
        .alert-warn { background: #FEF3C7; border: 1.5px solid #FCD34D; border-radius: var(--radius-sm); padding: .6rem 1rem; font-size: .82rem; color: #92400E; text-align: center; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app">
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>