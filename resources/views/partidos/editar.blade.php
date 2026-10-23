@extends('layouts.principal')
@section('title', 'Editar partido')
@section('content')
<div class="card" style="max-width:760px"><h1>Editar partido</h1><form method="POST" action="{{ route('partidos.update', $partido) }}">@csrf @method('PUT') @include('partidos.formulario')<button class="btn">Actualizar</button> <a class="btn btn-secondary" href="{{ route('partidos.show', $partido) }}">Cancelar</a></form></div>
@endsection
