<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jugador extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = ['equipo_id', 'nombre', 'apellido', 'dorsal', 'posicion'];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
