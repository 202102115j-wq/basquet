@extends('layouts.principal')
@section('title', 'Editar equipo')
@section('content')
<div class="card" style="max-width:700px"><h1>Editar equipo</h1><form method="POST" action="{{ route('equipos.update', $equipo) }}">@csrf @method('PUT') @include('equipos.formulario')<button class="btn">Actualizar</button> <a class="btn btn-secondary" href="{{ route('equipos.show', $equipo) }}">Cancelar</a></form></div>
@endsection
