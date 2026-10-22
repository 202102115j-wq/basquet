@extends('layouts.principal')
@section('title', 'Inicio')
@section('content')
<h1>Panel de la liga</h1>
<div class="grid">
    <div class="card"><div class="muted">Equipos</div><div class="metric">{{ $equipos }}</div></div>
    <div class="card"><div class="muted">Jugadores</div><div class="metric">{{ $jugadores }}</div></div>
    <div class="card"><div class="muted">Partidos</div><div class="metric">{{ $partidos }}</div></div>
    <div class="card"><div class="muted">Finalizados</div><div class="metric">{{ $finalizados }}</div></div>
</div>
<div class="card">
    <h2>Próximos partidos</h2>
    <table><thead><tr><th>Fecha</th><th>Encuentro</th><th>Lugar</th></tr></thead><tbody>
    @forelse ($proximos as $partido)
        <tr><td>{{ $partido->fecha_hora->format('d/m/Y H:i') }}</td><td>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</td><td>{{ $partido->lugar ?: '-' }}</td></tr>
    @empty <tr><td colspan="3">No hay partidos programados.</td></tr> @endforelse
    </tbody></table>
</div>
@endsection
