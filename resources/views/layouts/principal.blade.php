<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Liga de Básquetbol')</title>
    <style>
        :root { font-family: Arial, Helvetica, sans-serif; color: #1f2937; background: #f3f4f6; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        nav { background: #111827; color: white; padding: 14px 0; }
        .container { width: min(1100px, 92%); margin: 0 auto; }
        nav .container { display: flex; align-items: center; gap: 18px; flex-wrap: wrap; }
        nav a { color: white; text-decoration: none; }
        nav .brand { font-weight: 700; margin-right: auto; }
        main { padding: 28px 0 50px; }
        h1 { margin-top: 0; }
        .card { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 14px; }
        .metric { font-size: 2rem; font-weight: 700; margin: 8px 0 0; }
        label { font-weight: 700; display: block; margin-bottom: 6px; }
        input, select { width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 7px; background: white; }
        .field { margin-bottom: 16px; }
        .btn { display: inline-block; border: 0; border-radius: 7px; padding: 9px 14px; text-decoration: none; cursor: pointer; background: #2563eb; color: white; font-size: .95rem; }
        .btn-secondary { background: #4b5563; }
        .btn-danger { background: #b91c1c; }
        .btn-success { background: #047857; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; border-bottom: 1px solid #e5e7eb; padding: 10px 8px; vertical-align: top; }
        th { background: #f8fafc; }
        .actions { display: flex; gap: 7px; flex-wrap: wrap; }
        .inline { display: inline; }
        .alert { padding: 12px 14px; border-radius: 8px; margin-bottom: 18px; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-error { background: #fee2e2; color: #991b1b; }
        .muted { color: #6b7280; }
        .badge { border-radius: 999px; padding: 4px 9px; font-size: .8rem; background: #e5e7eb; }
        .badge-finalizado { background: #d1fae5; color: #065f46; }
        .badge-programado { background: #dbeafe; color: #1e40af; }
        @media (max-width: 700px) { table { display: block; overflow-x: auto; } }
    </style>
</head>
<body>
<nav>
    <div class="container">
        <a class="brand" href="{{ auth()->check() ? route('dashboard') : route('login') }}">Liga de Básquetbol</a>
        @auth
            <a href="{{ route('dashboard') }}">Inicio</a>
            <a href="{{ route('equipos.index') }}">Equipos</a>
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
