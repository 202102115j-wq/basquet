<?php
namespace Tests\Feature;
use App\Models\Equipo;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
class PruebaProgramacionPartidosTest extends TestCase
{
    use RefreshDatabase;
    public function test_programa_un_partido_sin_resultado(): void
    {
        $usuario=Usuario::create(['name'=>'Prueba','email'=>'prueba-fecha@example.com','password'=>Hash::make('password123')]);
        $a=Equipo::create(['nombre'=>'Lobos','ciudad'=>'Cusco']);
        $b=Equipo::create(['nombre'=>'Pumas','ciudad'=>'Cusco']);
        $this->actingAs($usuario)->post('/partidos', [
           'fecha_hora'=>now()->addDay()->format('Y-m-d H:i:s'),'lugar'=>'Coliseo',
           'equipo_local_id'=>$a->id,'equipo_visitante_id'=>$b->id,'estado'=>'programado'
        ])->assertRedirect();
        $this->assertDatabaseHas('partidos',['equipo_local_id'=>$a->id,'equipo_visitante_id'=>$b->id,'estado'=>'programado', 'puntos_local'=>null]);
    }
}
