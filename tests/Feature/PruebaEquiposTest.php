<?php
namespace Tests\Feature;
use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class PruebaEquiposTest extends TestCase
{
    use RefreshDatabase;
    public function test_un_usuario_autenticado_puede_crear_y_editar_equipo(): void
    {
        $usuario = Usuario::create(['name'=>'Prueba', 'email'=>'prueba-equipos@example.com', 'password'=>Hash::make('password123')]);
        $this->actingAs($usuario)->post('/equipos', [
            'nombre'=>'Aguilas','ciudad'=>'Cusco','entrenador'=>'Jose'
        ])->assertRedirect();
        $equipo = Equipo::where('nombre','Aguilas')->firstOrFail();
        $this->actingAs($usuario)->put('/equipos/'.$equipo->id, [
            'nombre'=>'Aguilas','ciudad'=>'Arequipa','entrenador'=>'Jose'
        ])->assertRedirect();
        $this->assertDatabaseHas('equipos',['id'=>$equipo->id,'ciudad'=>'Arequipa']);
    }
}
