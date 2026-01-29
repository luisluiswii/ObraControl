<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obra extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nombre',
        'direccion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    /**
     * Trabajadores asignados a la obra (relación muchos a muchos)
     */
    public function trabajadores()
    {
        return $this->belongsToMany(
            Trabajador::class,
            'obra_trabajador',
            'obra_id',
            'trabajador_id'
        )
        ->withPivot('fecha_asignacion', 'fecha_fin')
        ->withTimestamps();
    }

    /**
     * Fichajes asociados a esta obra
     */
    public function fichajes()
    {
        return $this->hasMany(Fichaje::class);
    }
}
