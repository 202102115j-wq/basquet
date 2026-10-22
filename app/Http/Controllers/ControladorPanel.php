<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Partido;
use Illuminate\View\View;

class ControladorPanel extends Controlador
{
    public function index(): View
    {
        return view('panel', [
            'equipos' => Equipo::count(),
            'jugadores' => Jugador::count(),
            'partidos' => Partido::count(),
            'finalizados' => Partido::where('estado', 'finalizado')->count(),
            'proximos' => Partido::with(['local', 'visitante'])
                ->where('estado', 'programado')
                ->orderBy('fecha_hora')
                ->limit(5)
                ->get(),
        ]);
    }
}
