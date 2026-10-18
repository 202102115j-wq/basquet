@extends('layouts.principal')
@section('title', 'Registro')
@section('content')
<div class="card" style="max-width:520px;margin:auto;">
    <h1>Crear cuenta</h1>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="field"><label>Nombre</label><input name="name" value="{{ old('name') }}" required></div>
        <div class="field"><label>Correo</label><input type="email" name="email" value="{{ old('email') }}" required></div>
        <div class="field"><label>Contraseña</label><input type="password" name="password" required></div>
        <div class="field"><label>Confirmar contraseña</label><input type="password" name="password_confirmation" required></div>
        <button class="btn" type="submit">Registrarme</button>
    </form>
</div>
@endsection
