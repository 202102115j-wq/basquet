<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ControladorJugador extends Controlador
{
    public function create(Equipo $equipo): View
    {
        return view('jugadores.crear', compact('equipo'));
    }

    public function store(Request $request, Equipo $equipo): RedirectResponse
    {
        $data = $this->validateJugador($request, $equipo);
        $equipo->jugadores()->create($data);

        return redirect()->route('equipos.show', $equipo)->with('success', 'Jugador agregado al equipo.');
    }


    private function validateJugador(Request $request, Equipo $equipo, ?Jugador $jugador = null): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'dorsal' => [
                'nullable', 'integer', 'between:0,99',
                Rule::unique('jugadores', 'dorsal')->where(fn ($query) => $query->where('equipo_id', $equipo->id))->ignore($jugador?->id),
            ],
            'posicion' => ['nullable', Rule::in(['Base', 'Escolta', 'Alero', 'Ala-pivot', 'Pivot'])],
        ]);
    }
}
