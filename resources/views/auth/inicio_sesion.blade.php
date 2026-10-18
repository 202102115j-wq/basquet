@extends('layouts.principal')
@section('title', 'Iniciar sesión')
@section('content')
<div class="card" style="max-width:520px;margin:auto;">
    <h1>Iniciar sesión</h1>
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="field"><label>Correo</label><input type="email" name="email" value="{{ old('email') }}" required autofocus></div>
        <div class="field"><label>Contraseña</label><input type="password" name="password" required></div>
        <div class="field"><label style="font-weight:normal"><input style="width:auto" type="checkbox" name="remember" value="1"> Recordarme</label></div>
        <button class="btn" type="submit">Ingresar</button>
    </form>
</div>
@endsection
