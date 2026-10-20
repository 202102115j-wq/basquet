@extends('layouts.principal')
@section('title', 'Agregar jugador')
@section('content')
<div class="card" style="max-width:700px"><h1>Agregar jugador a {{ $equipo->nombre }}</h1><form method="POST" action="{{ route('equipos.jugadores.store', $equipo) }}">@csrf @include('jugadores.formulario')<button class="btn">Guardar</button> <a class="btn btn-secondary" href="{{ route('equipos.show', $equipo) }}">Cancelar</a></form></div>
@endsection
