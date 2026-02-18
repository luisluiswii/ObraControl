<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trabajador extends Model
{
    use HasFactory, SoftDeletes;

    // Nombre correcto de la tabla
    protected $table = 'trabajadores';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'dni',
        'telefono',
        'email',
        'puesto',
        'salario_hora',
        'foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function obras()
    {
        return $this->belongsToMany(
            Obra::class,
            'obra_trabajador',
            'trabajador_id',
            'obra_id'
        )
        ->withPivot('fecha_asignacion', 'fecha_fin')
        ->withTimestamps();
    }
}
