<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Spatie\Permission\Traits\HasRoles;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPanelShield;


    protected $table='users';

    protected $fillable = [
        'name',
        'documento',
        'direccion',
        'email',
        'telefono',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación con los cursos que imparte (como docente)
    public function cursosImpartidos(): HasMany
    {
        return $this->hasMany(Curso::class, 'docente_id');
    }

    // Relación con las matrículas (como estudiante)
    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class, 'estudiante_id');
    }

    // Relación con los cursos registrados (como estudiante)
    public function cursosRegistrados(): HasMany
    {
        return $this->hasMany(CursoRegistrado::class, 'estudiante_id');
    }
   
    // Método requerido por Filament
    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Personaliza según tus necesidades de acceso
    }

    public function scopeFiltrarPorRol(Builder $query, User $usuarioActual): Builder
    {
        if ($usuarioActual->hasRole('super_admin')) {
            return $query; // No aplica ningún filtro, muestra todo
        }

        if ($usuarioActual->hasRole('Docente')) {
            return $query->whereHas('roles', fn ($q) => $q->where('name', 'Estudiante')); // Solo estudiantes
        }

        if ($usuarioActual->hasRole('Admin')) {
            return $query->whereHas('roles', fn ($q) => $q->where('name', 'Docente')); // Solo docentes
        }

        return $query->where('id', $usuarioActual->id); // Otros roles ven solo su propio perfil
    }
    
}
