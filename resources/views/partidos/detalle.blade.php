@extends('layouts.principal')
@section('title', 'Detalle del partido')
@section('content')
<div class="card"><h1>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</h1><p><strong>Fecha:</strong> {{ $partido->fecha_hora->format('d/m/Y H:i') }}<br><strong>Lugar:</strong> {{ $partido->lugar ?: '-' }}<br><strong>Estado:</strong> {{ ucfirst($partido->estado) }}</p>@if($partido->estado === 'finalizado')<p class="metric">{{ $partido->puntos_local }} - {{ $partido->puntos_visitante }}</p>@endif<div class="actions"><a class="btn" href="{{ route('partidos.edit', $partido) }}">Editar</a><a class="btn btn-secondary" href="{{ route('partidos.index') }}">Volver</a></div></div>
@endsection
