@extends('layouts.principal')
@section('title', 'Panel')
@section('content')
<h1>Panel de la liga</h1>
<div class="card"><h2>Equipos registrados</h2><p class="metric">{{ $equipos }}</p></div>
@endsection
