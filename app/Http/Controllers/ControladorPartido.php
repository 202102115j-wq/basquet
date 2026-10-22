<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ControladorPartido extends Controlador
{
    public function index(): View
    {
        return view('partidos.listado', [
            'partidos' => Partido::with(['local', 'visitante'])
                ->orderByDesc('fecha_hora')
                ->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('partidos.crear', [
            'equipos' => Equipo::orderBy('nombre')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $partido = Partido::create($this->validarPartido($request));

        return redirect()
            ->route('partidos.show', $partido)
            ->with('success', 'Partido registrado correctamente.');
    }

    public function show(Partido $partido): View
    {
        $partido->load(['local', 'visitante']);

        return view('partidos.detalle', compact('partido'));
    }


    private function validarPartido(Request $request): array
    {
        $datos = $request->validate([
            'fecha_hora' => ['required', 'date'],
            'lugar' => ['nullable', 'string', 'max:180'],
            'equipo_local_id' => ['required', 'exists:equipos,id'],
            'equipo_visitante_id' => ['required', 'different:equipo_local_id', 'exists:equipos,id'],
            'estado' => ['required', Rule::in(['programado'])],
            'puntos_local' => ['nullable', 'required_if:estado,finalizado', 'integer', 'min:0', 'max:300'],
            'puntos_visitante' => ['nullable', 'required_if:estado,finalizado', 'integer', 'min:0', 'max:300'],
        ]);

        if ($datos['estado'] === 'programado') {
            $datos['puntos_local'] = null;
            $datos['puntos_visitante'] = null;

            return $datos;
        }

        if ((int) $datos['puntos_local'] === (int) $datos['puntos_visitante']) {
            throw ValidationException::withMessages([
                'puntos_visitante' => 'Un partido finalizado de básquetbol no puede quedar empatado.',
            ]);
        }

        return $datos;
    }
}
