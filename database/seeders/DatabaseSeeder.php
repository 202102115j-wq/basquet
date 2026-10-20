<?php

namespace Database\Seeders;

use App\Models\Equipo;
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

        $equipo = Equipo::firstOrCreate(
            ['nombre' => 'Halcones'],
            ['ciudad' => 'Cusco', 'entrenador' => 'Carlos Quispe']
        );

        $equipo->jugadores()->firstOrCreate(
            ['dorsal' => 7],
            ['nombre' => 'Luis', 'apellido' => 'Flores', 'posicion' => 'Base']
        );
    }
}
