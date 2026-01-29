<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'trabajador_id',
        'obra_id',
        'fecha',
        'hora_entrada',
        'hora_salida',
        'horas_trabajadas',
    ];

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class);
    }
}
