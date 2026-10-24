@extends('layouts.principal')
@section('title', 'Estadísticas')
@section('content')
<h1>Resultados y estadísticas</h1>
<div class="card"><h2>Tabla general</h2><table><thead><tr><th>#</th><th>Equipo</th><th>PJ</th><th>PG</th><th>PP</th><th>PF</th><th>PC</th><th>DIF</th><th>Efectividad</th></tr></thead><tbody>
@forelse($tabla as $fila)
<tr><td>{{ $loop->iteration }}</td><td>{{ $fila['equipo']->nombre }}</td><td>{{ $fila['pj'] }}</td><td>{{ $fila['pg'] }}</td><td>{{ $fila['pp'] }}</td><td>{{ $fila['pf'] }}</td><td>{{ $fila['pc'] }}</td><td>{{ $fila['dif'] > 0 ? '+' : '' }}{{ $fila['dif'] }}</td><td>{{ $fila['efectividad'] }}%</td></tr>
@empty <tr><td colspan="9">No hay equipos registrados.</td></tr> @endforelse
</tbody></table></div>
<div class="card"><h2>Últimos resultados</h2><table><thead><tr><th>Fecha</th><th>Partido</th><th>Marcador</th></tr></thead><tbody>
@forelse($ultimosPartidos as $partido)
<tr><td>{{ $partido->fecha_hora->format('d/m/Y') }}</td><td>{{ $partido->local->nombre }} vs {{ $partido->visitante->nombre }}</td><td><strong>{{ $partido->puntos_local }} - {{ $partido->puntos_visitante }}</strong></td></tr>
@empty <tr><td colspan="3">Aún no existen resultados finalizados.</td></tr> @endforelse
</tbody></table></div>
@endsection
