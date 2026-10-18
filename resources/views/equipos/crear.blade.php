@extends('layouts.principal')
@section('title', 'Nuevo equipo')
@section('content')
<div class="card" style="max-width:700px"><h1>Nuevo equipo</h1><form method="POST" action="{{ route('equipos.store') }}">@csrf @include('equipos.formulario')<button class="btn">Guardar</button> <a class="btn btn-secondary" href="{{ route('equipos.index') }}">Cancelar</a></form></div>
@endsection
