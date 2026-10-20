<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = ['nombre', 'ciudad', 'entrenador'];

    public function jugadores(): HasMany
    {
        return $this->hasMany(Jugador::class);
    }
}
