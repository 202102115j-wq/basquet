<?php

use App\Http\Controllers\ControladorAutenticacion;
use App\Http\Controllers\ControladorEquipo;
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
});
