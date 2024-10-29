<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cursos extends Model
{
    use HasFactory;
    protected $table='cursos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel',
        'codigo_interno',
        'vigencia',
        'fecha_inicio',
        'fecha_final',
        'cupo_máximo',
        'docente_id',
    ];

    protected $casts = [
        'vigencia' => 'date',
        'fecha_inicio' => 'date',
        'fecha_final' => 'date',
        'nivel' => 'integer',
    ];

    public function docente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matriculas::class);
    }

    public function cursosRegistrados(): HasMany
    {
        return $this->hasMany(Curso_Registrados::class);
    }

    // Método para verificar si hay cupos disponibles
    public function hayCuposDisponibles(): bool
    {
        return $this->matriculas()->count() < $this->cupo_máximo;
    }


}
