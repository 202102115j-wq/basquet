<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PruebaPartidosTest extends TestCase
{
    use RefreshDatabase;

    public function test_no_se_permite_el_mismo_equipo_como_local_y_visitante(): void
    {
        $usuario = $this->usuario();
        $equipo = Equipo::create(['nombre' => 'Único', 'ciudad' => 'Cusco']);

        $this->actingAs($usuario)->post('/partidos', [
            'fecha_hora' => now()->addDay()->format('Y-m-d H:i:s'),
            'lugar' => 'Coliseo',
            'equipo_local_id' => $equipo->id,
            'equipo_visitante_id' => $equipo->id,
            'estado' => 'programado',
        ])->assertSessionHasErrors('equipo_visitante_id');
    }

    public function test_partido_finalizado_no_puede_quedar_empatado(): void
    {
        $usuario = $this->usuario('empate@example.com');
        $local = Equipo::create(['nombre' => 'Local', 'ciudad' => 'Cusco']);
        $visitante = Equipo::create(['nombre' => 'Visitante', 'ciudad' => 'Cusco']);

        $this->actingAs($usuario)->post('/partidos', [
            'fecha_hora' => now()->format('Y-m-d H:i:s'),
            'lugar' => 'Coliseo',
            'equipo_local_id' => $local->id,
            'equipo_visitante_id' => $visitante->id,
            'estado' => 'finalizado',
            'puntos_local' => 80,
            'puntos_visitante' => 80,
        ])->assertSessionHasErrors('puntos_visitante');
    }

    private function usuario(string $correo = 'partido@example.com'): Usuario
    {
        return Usuario::create([
            'name' => 'Usuario Prueba',
            'email' => $correo,
            'password' => Hash::make('password123'),
        ]);
    }
}
