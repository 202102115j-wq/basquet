<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Roboto+Condensed:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>@yield('title', 'Liga de Básquetbol')</title>
    <style>

        :root {
            --nba-blue: #1d428a;
            --nba-red: #c8102e;
            --ink: #111827;
            --muted: #667085;
            --line: #e2e8f0;
            --surface: #ffffff;
            --page: #f3f5f8;
            --nav: #080b12;
            color: var(--ink);
            background: var(--page);
            font-family: 'Roboto Condensed', 'Arial Narrow', Arial, sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            background: var(--page);
            color: var(--ink);
            font-family: 'Roboto Condensed', 'Arial Narrow', Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
        }

        body::before {
            content: "";
            display: block;
            height: 4px;
            background: linear-gradient(90deg, var(--nba-blue) 0 49%, var(--nba-red) 49% 100%);
        }

        body > nav {
            padding: 0;
            color: #fff;
            background: var(--nav);
            border-bottom: 1px solid rgba(255,255,255,.1);
            box-shadow: 0 5px 18px rgba(8,11,18,.13);
        }

        .container {
            width: min(1200px, 92%);
            margin: 0 auto;
        }

        body > nav .container {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            min-height: 76px;
        }

        body > nav a {
            color: #f9fafb;
            text-decoration: none;
        }

        body > nav .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            margin-right: auto;
            padding: 12px 18px 12px 0;
            color: #fff;
            font-family: 'Oswald', 'Roboto Condensed', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: .035em;
            line-height: 1.1;
            text-transform: uppercase;
            white-space: nowrap;
        }

        body > nav .brand::before {
            content: "";
            display: inline-block;
            flex: 0 0 30px;
            width: 30px;
            height: 30px;
            border: 2px solid #fff;
            border-radius: 50%;
            background:
                linear-gradient(90deg, transparent 46%, rgba(255,255,255,.95) 47% 51%, transparent 52%),
                linear-gradient(0deg, transparent 46%, rgba(255,255,255,.95) 47% 51%, transparent 52%),
                var(--nba-red);
            box-shadow: 0 0 0 3px rgba(200,16,46,.18);
        }

        body > nav a:not(.brand) {
            display: inline-flex;
            align-items: center;
            min-height: 76px;
            padding: 0 13px;
            border-bottom: 3px solid transparent;
            color: #e5e7eb;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .065em;
            text-transform: uppercase;
            transition: color .18s ease, border-color .18s ease, background .18s ease;
        }

        body > nav a:not(.brand):hover,
        body > nav a:not(.brand):focus-visible {
            color: #fff;
            border-bottom-color: var(--nba-red);
            background: rgba(255,255,255,.045);
        }

        main.container {
            padding: 34px 0 60px;
        }

        h1, h2, h3, h4 {
            color: #111827;
            font-family: 'Oswald', 'Roboto Condensed', 'Arial Narrow', sans-serif;
            font-weight: 600;
            letter-spacing: .015em;
            line-height: 1.2;
            text-transform: uppercase;
        }

        h1 {
            position: relative;
            margin: 0 0 23px;
            padding-left: 15px;
            font-size: clamp(1.8rem, 3vw, 2.45rem);
        }

        h1::before {
            position: absolute;
            top: .12em;
            bottom: .12em;
            left: 0;
            width: 4px;
            border-radius: 2px;
            background: var(--nba-red);
            content: "";
        }

        h2 {
            margin: 0 0 18px;
            padding-bottom: 11px;
            border-bottom: 1px solid var(--line);
            font-size: 1.4rem;
        }

        h3 { font-size: 1.15rem; }

        p { margin-top: 0; }

        main a:not(.btn) {
            color: var(--nba-blue);
            font-weight: 600;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        main a:not(.btn):hover { color: var(--nba-red); }

        .card {
            position: relative;
            margin-bottom: 22px;
            padding: 24px;
            overflow: hidden;
            border: 1px solid #e1e6ed;
            border-radius: 6px;
            background: var(--surface);
            box-shadow: 0 3px 12px rgba(16,24,40,.045);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 16px;
        }

        .grid > .card {
            min-height: 126px;
            border-top: 4px solid var(--nba-blue);
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .grid > .card:nth-child(even) { border-top-color: var(--nba-red); }

        .grid > .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16,24,40,.08);
        }

        .metric {
            margin: 8px 0 0;
            color: var(--nba-blue);
            font-family: 'Oswald', 'Roboto Condensed', sans-serif;
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 600;
            letter-spacing: -.025em;
            line-height: 1.1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #344054;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .035em;
            text-transform: uppercase;
        }

        input, select, textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            background: #fff;
            color: #101828;
            font: inherit;
            transition: border-color .16s ease, box-shadow .16s ease;
        }

        input::placeholder, textarea::placeholder { color: #98a2b3; }

        input:focus, select:focus, textarea:focus {
            border-color: var(--nba-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(29,66,138,.12);
        }

        input[type="checkbox"],
        input[type="radio"] {
            width: auto;
            accent-color: var(--nba-red);
        }

        .field { margin-bottom: 17px; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 16px;
            border: 1px solid var(--nba-red);
            border-radius: 4px;
            background: var(--nba-red);
            color: #fff;
            cursor: pointer;
            font-family: 'Roboto Condensed', 'Arial Narrow', sans-serif;
            font-size: .84rem;
            font-weight: 700;
            letter-spacing: .045em;
            line-height: 1.25;
            text-decoration: none;
            text-transform: uppercase;
            transition: background .16s ease, border-color .16s ease, transform .16s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            border-color: #a90e28;
            background: #a90e28;
            color: #fff;
        }

        .btn:focus-visible {
            outline: 3px solid rgba(29,66,138,.35);
            outline-offset: 2px;
        }

        .btn-secondary {
            border-color: var(--nba-blue);
            background: var(--nba-blue);
        }

        .btn-secondary:hover {
            border-color: #16346d;
            background: #16346d;
        }

        .btn-danger {
            border-color: #b42318;
            background: #b42318;
        }

        .btn-danger:hover {
            border-color: #912018;
            background: #912018;
        }

        .btn-success {
            border-color: #087443;
            background: #087443;
        }

        .btn-success:hover {
            border-color: #065b35;
            background: #065b35;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            font-size: .94rem;
        }

        th, td {
            padding: 12px 11px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: middle;
        }

        th {
            border-bottom: 3px solid var(--nba-red);
            background: #111827;
            color: #fff;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .065em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody tr:nth-child(even) { background: #f8fafc; }
        tbody tr:hover { background: #eef3fb; }

        tbody tr:last-child td { border-bottom-color: #d5dce5; }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
            flex-wrap: wrap;
        }

        .inline { display: inline; }

        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid transparent;
            border-left-width: 4px;
            border-radius: 4px;
            font-weight: 600;
        }

        .alert-success {
            border-left-color: #079455;
            background: #ecfdf3;
            color: #05603a;
        }

        .alert-error {
            border-left-color: var(--nba-red);
            background: #fff1f2;
            color: #9f1239;
        }

        .muted { color: var(--muted); }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 3px;
            background: #e5e7eb;
            color: #344054;
            font-size: .74rem;
            font-weight: 700;
            letter-spacing: .035em;
            text-transform: uppercase;
        }

        .badge-finalizado {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-programado {
            background: #dbeafe;
            color: #1e40af;
        }

        main nav[role="navigation"] {
            padding: 12px 0;
            border: 0;
            background: transparent;
            box-shadow: none;
            color: var(--ink);
        }

        main nav[role="navigation"] a {
            min-height: auto;
            padding: 7px 10px;
            border: 1px solid #dbe2ea;
            border-radius: 4px;
            background: #fff;
            color: var(--nba-blue);
            font-size: .85rem;
            text-transform: none;
        }

        main nav[role="navigation"] a:hover {
            border-color: var(--nba-blue);
            background: #f0f5ff;
            color: var(--nba-blue);
        }

        @media (max-width: 760px) {
            body > nav .container {
                min-height: auto;
                gap: 4px;
                padding: 12px 0 0;
            }

            body > nav .brand {
                width: 100%;
                margin-right: 0;
                padding: 4px 0 10px;
            }

            body > nav a:not(.brand) {
                min-height: 42px;
                padding: 0 10px;
                font-size: .75rem;
            }

            body > nav form { padding-bottom: 8px; }

            main.container { padding-top: 25px; }

            .card { padding: 17px; }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .actions { gap: 6px; }
            .btn { padding: 9px 11px; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }

    </style>
</head>
<body>
<nav>
    <div class="container">
        <a class="brand" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Liga de Básquetbol</a>
        @auth
            <a href="{{ route('dashboard') }}">Inicio</a>
            <a href="{{ route('equipos.index') }}">Equipos</a>
            <a href="{{ route('partidos.index') }}">Partidos</a>
            <a href="{{ route('estadisticas.index') }}">Estadísticas</a>
            <form class="inline" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-secondary" type="submit">Salir</button>
            </form>
        @else
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        @endauth
    </div>
</nav>
<main class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Corrige los siguientes datos:</strong>
            <ul>
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
