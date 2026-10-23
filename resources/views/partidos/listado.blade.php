@extends('layouts.principal')
@section('title', 'Partidos')
@section('content')
<div class="actions" style="justify-content:space-between;align-items:center;margin-bottom:16px"><h1 style="margin:0">Partidos</h1><a class="btn" href="{{ route('partidos.create') }}">Nuevo partido</a></div>
<div class="card"><table><thead><tr><th>Fecha</th><th>Encuentro</th><th>Resultado</th><th>Estado</th><th>Acciones</th></tr></thead><tbody>
@forelse ($partidos as $partido)
<tr><td>{{ $partido->fecha_hora->format('d/m/Y H:i') }}</td><td>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</td><td>{{ $partido->estado === 'finalizado' ? $partido->puntos_local.' - '.$partido->puntos_visitante : '-' }}</td><td><span class="badge badge-{{ $partido->estado }}">{{ ucfirst($partido->estado) }}</span></td><td class="actions"><a class="btn btn-secondary" href="{{ route('partidos.show', $partido) }}">Ver</a><a class="btn" href="{{ route('partidos.edit', $partido) }}">Editar</a><form method="POST" action="{{ route('partidos.destroy', $partido) }}" onsubmit="return confirm('Eliminar partido?')">@csrf @method('DELETE')<button class="btn btn-danger">Eliminar</button></form></td></tr>
@empty <tr><td colspan="5">No hay partidos registrados.</td></tr> @endforelse
</tbody></table><div style="margin-top:15px">{{ $partidos->links() }}</div></div>
@endsection
