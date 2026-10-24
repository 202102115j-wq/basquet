<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PruebaEstadisticasTest extends TestCase
{
    use RefreshDatabase;

    public function test_las_estadisticas_requieren_iniciar_sesion(): void
    {
        $this->get('/estadisticas')->assertRedirect('/login');
    }

    public function test_se_muestra_la_tabla_sin_equipos(): void
    {
        $this->actingAs($this->crearUsuario())
            ->get('/estadisticas')
            ->assertOk()
            ->assertSee('No hay equipos registrados.')
            ->assertSee('Aún no existen resultados finalizados.');
    }

    public function test_calcula_resultados_y_no_cuenta_partidos_programados(): void
    {
        $usuario = $this->crearUsuario();
        $halcones = Equipo::create(['nombre' => 'Halcones', 'ciudad' => 'Cusco']);
        $pumas = Equipo::create(['nombre' => 'Pumas', 'ciudad' => 'Cusco']);
        $titanes = Equipo::create(['nombre' => 'Titanes', 'ciudad' => 'Cusco']);

        Partido::create([
            'fecha_hora' => now()->subDays(2),
            'lugar' => 'Coliseo',
            'equipo_local_id' => $halcones->id,
            'equipo_visitante_id' => $pumas->id,
            'puntos_local' => 80,
            'puntos_visitante' => 72,
            'estado' => 'finalizado',
        ]);

        Partido::create([
            'fecha_hora' => now()->subDay(),
            'lugar' => 'Coliseo',
            'equipo_local_id' => $titanes->id,
            'equipo_visitante_id' => $halcones->id,
            'puntos_local' => 64,
            'puntos_visitante' => 70,
            'estado' => 'finalizado',
        ]);

        Partido::create([
            'fecha_hora' => now()->addDay(),
            'lugar' => 'Coliseo',
            'equipo_local_id' => $pumas->id,
            'equipo_visitante_id' => $titanes->id,
            'estado' => 'programado',
        ]);

        $this->actingAs($usuario)
            ->get('/estadisticas')
            ->assertOk()
            ->assertSee('80 - 72')
            ->assertSee('64 - 70')
            ->assertViewHas('tabla', function ($tabla) use ($halcones, $pumas, $titanes): bool {
                if ($tabla->count() !== 3) {
                    return false;
                }

                $lider = $tabla[0];

                if ($lider['equipo']->id !== $halcones->id ||
                    $lider['pj'] !== 2 ||
                    $lider['pg'] !== 2 ||
                    $lider['pp'] !== 0 ||
                    $lider['pf'] !== 150 ||
                    $lider['pc'] !== 136 ||
                    $lider['dif'] !== 14 ||
                    $lider['efectividad'] != 100) {
                    return false;
                }

                $porId = $tabla->keyBy(fn (array $fila): int => $fila['equipo']->id);

                return $porId[$pumas->id]['pj'] === 1 &&
                    $porId[$pumas->id]['pp'] === 1 &&
                    $porId[$titanes->id]['pj'] === 1 &&
                    $porId[$titanes->id]['pp'] === 1;
            });
    }

    private function crearUsuario(): Usuario
    {
        return Usuario::create([
            'name' => 'Probador',
            'email' => 'estadisticas7@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
