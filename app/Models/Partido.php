<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partido extends Model
{
    use HasFactory;

    protected $table = 'partidos';

    protected $fillable = [
        'fecha_hora', 'lugar', 'equipo_local_id', 'equipo_visitante_id',
        'puntos_local', 'puntos_visitante', 'estado',
    ];

    protected function casts(): array
    {
        return ['fecha_hora' => 'datetime'];
    }

    public function local(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function visitante(): BelongsTo
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }
}
