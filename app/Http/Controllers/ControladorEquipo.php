<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ControladorEquipo extends Controlador
{
    public function index(): View
    {
        return view('equipos.listado', [
            'equipos' => Equipo::withCount('jugadores')->orderBy('nombre')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('equipos.crear');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', 'unique:equipos,nombre'],
            'ciudad' => ['required', 'string', 'max:120'],
            'entrenador' => ['nullable', 'string', 'max:120'],
        ]);

        $equipo = Equipo::create($data);
        return redirect()->route('equipos.show', $equipo)->with('success', 'Equipo registrado.');
    }

    public function show(Equipo $equipo): View
    {
        $equipo->load(['jugadores' => fn ($q) => $q->orderBy('apellido')->orderBy('nombre')]);
        return view('equipos.detalle', compact('equipo'));
    }

    public function edit(Equipo $equipo): View
    {
        return view('equipos.editar', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo): RedirectResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:120', 'unique:equipos,nombre,'.$equipo->id],
            'ciudad' => ['required', 'string', 'max:120'],
            'entrenador' => ['nullable', 'string', 'max:120'],
        ]);
        $equipo->update($data);
        return redirect()->route('equipos.show', $equipo)->with('success', 'Equipo actualizado.');
    }

    public function destroy(Equipo $equipo): RedirectResponse
    {
        if ($equipo->partidosComoLocal()->exists() || $equipo->partidosComoVisitante()->exists()) {
            return back()->withErrors(['equipo' => 'No se puede eliminar un equipo que ya participa en partidos.']);
        }
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado.');
    }
}
