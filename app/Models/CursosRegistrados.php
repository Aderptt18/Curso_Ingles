<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CursosRegistrados extends Model
{
    use HasFactory;
    protected $table='cursos_registrados';
    protected $fillable = [
        'fecha_matricula', 
        'grupo', 'nivel', 
        'fecha_fin_curso', 
        'definitiva', 
        'aprobado', 
        'aplazado', 
        'estudiante_id', 
        'curso_id'
    ];
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id')->where('estudiante', true);
    }

    // Relación con el curso
    public function curso()
    {
        return $this->belongsTo(Cursos::class);
    }
}
