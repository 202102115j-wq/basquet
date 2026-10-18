@extends('layouts.principal')
@section('title',$equipo->nombre)
@section('content')
<div class="card"><h1>{{ $equipo->nombre }}</h1>
<p><strong>Ciudad:</strong> {{ $equipo->ciudad }}</p>
<p><strong>Entrenador:</strong> {{ $equipo->entrenador ?: '-' }}</p>
<div class="actions">
<a class="btn" href="{{ route('equipos.edit', $equipo) }}">Editar equipo</a>
<a class="btn btn-secondary" href="{{ route('equipos.index') }}">Volver</a></div>
</div>
@endsection
