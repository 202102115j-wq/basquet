@extends('layouts.principal')
@section('title', 'Inicio')
@section('content')
<h1>Panel de la liga</h1>
<div class="grid">
    <div class="card"><div class="muted">Equipos</div><div class="metric">{{ $equipos }}</div></div>
    <div class="card"><div class="muted">Jugadores</div><div class="metric">{{ $jugadores }}</div></div>
</div>
@endsection
