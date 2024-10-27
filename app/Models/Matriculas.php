<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matriculas extends Model
{
    use HasFactory;
    protected $table='users';

    protected $fillable = [
        'fecha_matriculado',
        'curso_id',
        'estudiante_id',
    ];

    protected $casts = [
        'fecha_matriculado' => 'date',
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class);
    }

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }
}
