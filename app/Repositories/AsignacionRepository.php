<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AsignacionRepository implements AsignacionRepositoryInterface
{
    public function all(): Collection
    {
        return DB::table('obra_trabajador')
            ->join('obras', 'obras.id', '=', 'obra_trabajador.obra_id')
            ->join('trabajadores', 'trabajadores.id', '=', 'obra_trabajador.trabajador_id')
            ->select(
                'obra_trabajador.*',
                'obras.nombre as obra_nombre',
                'trabajadores.nombre as trabajador_nombre',
                'trabajadores.apellido as trabajador_apellido'
            )
            ->orderBy('obra_trabajador.id', 'desc')
            ->get();
    }

    public function create(array $data): void
    {
        DB::table('obra_trabajador')->insert([
            'obra_id' => $data['obra_id'],
            'trabajador_id' => $data['trabajador_id'],
            'fecha_asignacion' => $data['fecha_asignacion'],
            'fecha_fin' => $data['fecha_fin'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function delete(int $id): bool
    {
        return DB::table('obra_trabajador')
            ->where('id', $id)
            ->delete() > 0;
    }
}
