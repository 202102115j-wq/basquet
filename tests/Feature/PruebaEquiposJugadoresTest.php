<?php

namespace Tests\Feature;

use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PruebaEquiposJugadoresTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_puede_crear_equipo(): void
    {
        $usuario = $this->usuario();

        $this->actingAs($usuario)->post('/equipos', [
            'nombre' => 'Guerreros',
            'ciudad' => 'Cusco',
            'entrenador' => 'Entrenador Test',
        ])->assertRedirect();

        $this->assertDatabaseHas('equipos', ['nombre' => 'Guerreros']);
    }

    public function test_dorsal_no_se_repite_en_el_mismo_equipo(): void
    {
        $usuario = $this->usuario('jugador@example.com');
        $equipo = Equipo::create(['nombre' => 'Halcones Test', 'ciudad' => 'Cusco']);

        $this->actingAs($usuario)->post("/equipos/{$equipo->id}/jugadores", [
            'nombre' => 'Ana', 'apellido' => 'Quispe', 'dorsal' => 7, 'posicion' => 'Base',
        ])->assertRedirect();

        $this->actingAs($usuario)->post("/equipos/{$equipo->id}/jugadores", [
            'nombre' => 'Rosa', 'apellido' => 'Flores', 'dorsal' => 7, 'posicion' => 'Escolta',
        ])->assertSessionHasErrors('dorsal');
    }

    public function test_usuario_puede_abrir_formulario_y_actualizar_jugador(): void
    {
        $usuario = $this->usuario('edicion@example.com');
        $equipo = Equipo::create(['nombre' => 'Tigres', 'ciudad' => 'Cusco']);
        $jugador = $equipo->jugadores()->create([
            'nombre' => 'Ana',
            'apellido' => 'Lopez',
            'dorsal' => 5,
            'posicion' => 'Base',
        ]);

        $this->actingAs($usuario)
            ->get(route('jugadores.edit', $jugador))
            ->assertOk();

        $this->actingAs($usuario)
            ->put(route('jugadores.update', $jugador), [
                'nombre' => 'Ana Maria',
                'apellido' => 'Lopez',
                'dorsal' => 10,
                'posicion' => 'Escolta',
            ])
            ->assertRedirect(route('equipos.show', $equipo));

        $this->assertDatabaseHas('jugadores', [
            'id' => $jugador->id,
            'equipo_id' => $equipo->id,
            'nombre' => 'Ana Maria',
            'dorsal' => 10,
            'posicion' => 'Escolta',
        ]);
    }

    public function test_usuario_puede_eliminar_jugador(): void
    {
        $usuario = $this->usuario('eliminacion@example.com');
        $equipo = Equipo::create(['nombre' => 'Pumas', 'ciudad' => 'Cusco']);
        $jugador = $equipo->jugadores()->create([
            'nombre' => 'Luis',
            'apellido' => 'Garcia',
            'dorsal' => 4,
            'posicion' => 'Alero',
        ]);

        $this->actingAs($usuario)
            ->delete(route('jugadores.destroy', $jugador))
            ->assertRedirect(route('equipos.show', $equipo));

        $this->assertDatabaseMissing('jugadores', ['id' => $jugador->id]);
        $this->assertDatabaseHas('equipos', ['id' => $equipo->id]);
    }

    public function test_no_se_puede_cambiar_dorsal_a_otro_ocupado(): void
    {
        $usuario = $this->usuario('validacion@example.com');
        $equipo = Equipo::create(['nombre' => 'Osos', 'ciudad' => 'Cusco']);
        $equipo->jugadores()->create([
            'nombre' => 'Juan', 'apellido' => 'Lopez', 'dorsal' => 7, 'posicion' => 'Base',
        ]);
        $jugador = $equipo->jugadores()->create([
            'nombre' => 'Pedro', 'apellido' => 'Diaz', 'dorsal' => 8, 'posicion' => 'Pivot',
        ]);

        $this->actingAs($usuario)
            ->put(route('jugadores.update', $jugador), [
                'nombre' => 'Pedro', 'apellido' => 'Diaz', 'dorsal' => 7, 'posicion' => 'Pivot',
            ])
            ->assertSessionHasErrors('dorsal');

        $this->assertDatabaseHas('jugadores', ['id' => $jugador->id, 'dorsal' => 8]);
    }

    public function test_sin_iniciar_sesion_no_se_puede_editar_ni_eliminar(): void
    {
        $equipo = Equipo::create(['nombre' => 'Aguilas', 'ciudad' => 'Cusco']);
        $jugador = $equipo->jugadores()->create([
            'nombre' => 'Jorge', 'apellido' => 'Ruiz', 'dorsal' => 11, 'posicion' => 'Base',
        ]);

        $this->get(route('jugadores.edit', $jugador))
            ->assertRedirect(route('login'));
        $this->delete(route('jugadores.destroy', $jugador))
            ->assertRedirect(route('login'));
        $this->assertDatabaseHas('jugadores', ['id' => $jugador->id]);
    }

    private function usuario(string $correo = 'equipo@example.com'): Usuario
    {
        return Usuario::create([
            'name' => 'Usuario Prueba',
            'email' => $correo,
            'password' => Hash::make('password123'),
        ]);
    }
}
