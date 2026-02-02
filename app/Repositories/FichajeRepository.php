<?php

namespace App\Repositories;

use App\Models\Fichaje;
use Illuminate\Database\Eloquent\Collection;

class FichajeRepository implements FichajeRepositoryInterface
{
    public function all(): Collection
    {
        return Fichaje::with(['trabajador', 'obra'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function abiertas(): Collection
    {
        return Fichaje::with(['trabajador', 'obra'])
            ->whereNull('hora_salida')
            ->orderBy('hora_entrada', 'asc')
            ->get();
    }

    public function create(array $data): Fichaje
    {
        return Fichaje::create($data);
    }

    public function find(int $id): ?Fichaje
    {
        return Fichaje::find($id);
    }

    public function update(Fichaje $fichaje, array $data): bool
    {
        return $fichaje->update($data);
    }

    public function delete(Fichaje $fichaje): bool
    {
        return $fichaje->delete();
    }

    public function jornadas(): Collection
    {
        return Fichaje::with(['trabajador', 'obra'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->get();
    }
}
