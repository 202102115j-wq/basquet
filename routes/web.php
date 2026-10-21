<?php

use App\Http\Controllers\ControladorAutenticacion;
use App\Http\Controllers\ControladorEquipo;
use App\Http\Controllers\ControladorJugador;
use App\Http\Controllers\ControladorPanel;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('dashboard')
    : redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [ControladorAutenticacion::class, 'showLogin'])->name('login');
    Route::post('/login', [ControladorAutenticacion::class, 'login'])->name('login.store');
    Route::get('/registro', [ControladorAutenticacion::class, 'showRegister'])->name('register');
    Route::post('/registro', [ControladorAutenticacion::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [ControladorAutenticacion::class, 'logout'])->name('logout');
    Route::get('/dashboard', [ControladorPanel::class, 'index'])->name('dashboard');
    Route::resource('equipos', ControladorEquipo::class);

    Route::get('/equipos/{equipo}/jugadores/crear', [ControladorJugador::class, 'create'])->name('equipos.jugadores.create');
    Route::post('/equipos/{equipo}/jugadores', [ControladorJugador::class, 'store'])->name('equipos.jugadores.store');
    Route::get('/jugadores/{jugador}/editar', [ControladorJugador::class, 'edit'])->name('jugadores.edit');
    Route::put('/jugadores/{jugador}', [ControladorJugador::class, 'update'])->name('jugadores.update');
    Route::delete('/jugadores/{jugador}', [ControladorJugador::class, 'destroy'])->name('jugadores.destroy');
});
