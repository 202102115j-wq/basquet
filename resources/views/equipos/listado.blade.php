@extends('layouts.principal')
@section('title', 'Equipos')
@section('content')
<div class="actions" style="justify-content:space-between;align-items:center;margin-bottom:16px;">
    <h1 style="margin:0">Equipos</h1><a class="btn" href="{{ route('equipos.create') }}">Nuevo equipo</a>
</div>
<div class="card"><table><thead><tr><th>Nombre</th><th>Ciudad</th><th>Jugadores</th><th>Entrenador</th><th>Acciones</th></tr></thead><tbody>
@forelse ($equipos as $equipo)
<tr><td>{{ $equipo->nombre }}</td><td>{{ $equipo->ciudad }}</td><td>{{ $equipo->jugadores_count }}</td><td>{{ $equipo->entrenador ?: '-' }}</td><td class="actions"><a class="btn btn-secondary" href="{{ route('equipos.show', $equipo) }}">Ver</a><a class="btn" href="{{ route('equipos.edit', $equipo) }}">Editar</a><form method="POST" action="{{ route('equipos.destroy', $equipo) }}" onsubmit="return confirm('Eliminar este equipo?')">@csrf @method('DELETE')<button class="btn btn-danger">Eliminar</button></form></td></tr>
@empty <tr><td colspan="5">No hay equipos registrados.</td></tr> @endforelse
</tbody></table><div style="margin-top:15px">{{ $equipos->links() }}</div></div>
@endsection
