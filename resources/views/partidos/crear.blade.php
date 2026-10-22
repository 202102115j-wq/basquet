@extends('layouts.principal')
@section('title', 'Nuevo partido')
@section('content')
<div class="card" style="max-width:760px"><h1>Nuevo partido</h1>@if($equipos->count() < 2)<div class="alert alert-error">Se necesitan al menos dos equipos para registrar un partido.</div>@else<form method="POST" action="{{ route('partidos.store') }}">@csrf @include('partidos.formulario')<button class="btn">Guardar</button> <a class="btn btn-secondary" href="{{ route('partidos.index') }}">Cancelar</a></form>@endif</div>
@endsection
