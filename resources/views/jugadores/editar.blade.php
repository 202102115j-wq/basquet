@extends('layouts.principal')
@section('title', 'Editar jugador')
@section('content')
<div class="card" style="max-width:700px"><h1>Editar jugador de {{ $jugador->equipo->nombre }}</h1><form method="POST" action="{{ route('jugadores.update', $jugador) }}">@csrf @method('PUT') @include('jugadores.formulario')<button class="btn">Actualizar</button> <a class="btn btn-secondary" href="{{ route('equipos.show', $jugador->equipo) }}">Cancelar</a></form></div>
@endsection
