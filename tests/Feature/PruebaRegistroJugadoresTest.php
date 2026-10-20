<?php
namespace Tests\Feature;
use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class PruebaRegistroJugadoresTest extends TestCase
{
    use RefreshDatabase;
    public function test_puede_registrar_jugador_en_un_equipo(): void
    {
        $usuario = Usuario::create(['name'=>'Prueba', 'email'=>'prueba-alta@example.com', 'password'=>Hash::make('password123')]);
        $equipo = Equipo::create(['nombre'=>'Lobos','ciudad'=>'Cusco']);
        $this->actingAs($usuario)->post('/equipos/'.$equipo->id.'/jugadores', [
            'nombre'=>'Andrea','apellido'=>'Perez','dorsal'=>9,'posicion'=>'Base'
        ])->assertRedirect();
        $this->assertDatabaseHas('jugadores',['equipo_id'=>$equipo->id,'nombre'=>'Andrea','dorsal'=>9]);
    }
}
