@extends('layouts.principal')
@section('title', $equipo->nombre)
@section('content')
<div class="card"><div class="actions" style="justify-content:space-between"><div><h1>{{ $equipo->nombre }}</h1><p><strong>Ciudad:</strong> {{ $equipo->ciudad }}<br><strong>Entrenador:</strong> {{ $equipo->entrenador ?: '-' }}</p></div><a class="btn" href="{{ route('equipos.edit', $equipo) }}">Editar equipo</a></div></div>
<div class="card"><div class="actions" style="justify-content:space-between;align-items:center"><h2>Jugadores</h2><a class="btn btn-success" href="{{ route('equipos.jugadores.create', $equipo) }}">Agregar jugador</a></div><table><thead><tr><th>#</th><th>Jugador</th><th>Posición</th><th>Acciones</th></tr></thead><tbody>
@forelse ($equipo->jugadores as $jugador)
<tr><td>{{ $jugador->dorsal ?? '-' }}</td><td>{{ $jugador->apellido }}, {{ $jugador->nombre }}</td><td>{{ $jugador->posicion ?: '-' }}</td><td class="actions"><a class="btn" href="{{ route('jugadores.edit', $jugador) }}">Editar</a><form method="POST" action="{{ route('jugadores.destroy', $jugador) }}" onsubmit="return confirm('Eliminar jugador?')">@csrf @method('DELETE')<button class="btn btn-danger">Eliminar</button></form></td></tr>
@empty <tr><td colspan="4">Este equipo aún no tiene jugadores.</td></tr> @endforelse
</tbody></table></div>
@endsection
