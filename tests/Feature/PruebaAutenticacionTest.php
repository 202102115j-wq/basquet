<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PruebaAutenticacionTest extends TestCase
{
    use RefreshDatabase;

    public function test_visitante_es_redirigido_al_inicio_de_sesion(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_usuario_puede_registrarse(): void
    {
        $respuesta = $this->post('/registro', [
            'name' => 'Usuario Prueba',
            'email' => 'usuario@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $respuesta->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'usuario@example.com']);
    }
}
