<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\View\View;

class ControladorPanel extends Controlador
{
    public function index(): View
    {
        return view('panel', [
            'equipos' => Equipo::count(),
            'jugadores' => Jugador::count(),
        ]);
    }
}
