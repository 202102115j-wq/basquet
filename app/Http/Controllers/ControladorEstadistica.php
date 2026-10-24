<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ControladorEstadistica extends Controlador
{
    public function index(): View
    {
        $equipos = Equipo::orderBy('nombre')->get();
        $partidosFinalizados = Partido::with(['local', 'visitante'])
            ->where('estado', 'finalizado')
            ->orderByDesc('fecha_hora')
            ->get();

        $tabla = $this->construirTabla($equipos, $partidosFinalizados);

        return view('estadisticas.tabla_general', [
            'tabla' => $tabla,
            'ultimosPartidos' => $partidosFinalizados->take(10),
        ]);
    }

    private function construirTabla(Collection $equipos, Collection $partidos): Collection
    {
        return $equipos->map(function (Equipo $equipo) use ($partidos): array {
            $jugados = $partidos->filter(
                fn (Partido $partido): bool =>
                    $partido->equipo_local_id === $equipo->id ||
                    $partido->equipo_visitante_id === $equipo->id
            );

            $ganados = 0;
            $perdidos = 0;
            $puntosFavor = 0;
            $puntosContra = 0;

            foreach ($jugados as $partido) {
                $esLocal = $partido->equipo_local_id === $equipo->id;
                $pf = (int) ($esLocal ? $partido->puntos_local : $partido->puntos_visitante);
                $pc = (int) ($esLocal ? $partido->puntos_visitante : $partido->puntos_local);

                $puntosFavor += $pf;
                $puntosContra += $pc;

                if ($pf > $pc) {
                    $ganados++;
                } else {
                    $perdidos++;
                }
            }

            $cantidadJugados = $jugados->count();

            return [
                'equipo' => $equipo,
                'pj' => $cantidadJugados,
                'pg' => $ganados,
                'pp' => $perdidos,
                'pf' => $puntosFavor,
                'pc' => $puntosContra,
                'dif' => $puntosFavor - $puntosContra,
                'efectividad' => $cantidadJugados > 0
                    ? round(($ganados / $cantidadJugados) * 100, 1)
                    : 0,
            ];
        })->sort(function (array $a, array $b): int {
            return [$b['pg'], $b['dif'], $b['pf']] <=> [$a['pg'], $a['dif'], $a['pf']];
        })->values();
    }
}
