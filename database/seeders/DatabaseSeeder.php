<?php

namespace Database\Seeders;

use App\Models\Equipo;
use App\Models\Partido;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::updateOrCreate(
            ['email' => 'admin@liga.test'],
            ['name' => 'Administrador', 'password' => Hash::make('password123')]
        );

        $halcones = Equipo::firstOrCreate(
            ['nombre' => 'Halcones'],
            ['ciudad' => 'Cusco', 'entrenador' => 'Carlos Quispe']
        );
        $pumas = Equipo::firstOrCreate(
            ['nombre' => 'Pumas'],
            ['ciudad' => 'Wanchaq', 'entrenador' => 'Rosa Huamán']
        );

        $halcones->jugadores()->firstOrCreate(
            ['dorsal' => 7],
            ['nombre' => 'Luis', 'apellido' => 'Flores', 'posicion' => 'Base']
        );
        $pumas->jugadores()->firstOrCreate(
            ['dorsal' => 10],
            ['nombre' => 'Ana', 'apellido' => 'Rojas', 'posicion' => 'Alero']
        );

        Partido::firstOrCreate(
            [
                'equipo_local_id' => $halcones->id,
                'equipo_visitante_id' => $pumas->id,
                'estado' => 'programado',
            ],
            [
                'fecha_hora' => now()->addDays(3),
                'lugar' => 'Coliseo Cerrado',
            ]
        );
    }
}
