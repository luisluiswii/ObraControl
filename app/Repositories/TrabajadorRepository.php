    public function paginate($perPage = 10)
    {
        return Trabajador::orderBy('created_at', 'desc')->paginate($perPage);
    }
<?php

namespace App\Repositories;

use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Collection;

class TrabajadorRepository implements TrabajadorRepositoryInterface
{
    public function all(): Collection
    {
        return Trabajador::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data): Trabajador
    {
        return Trabajador::create($data);
    }

    public function update(Trabajador $trabajador, array $data): Trabajador
    {
        $trabajador->update($data);

        return $trabajador;
    }

    public function delete(Trabajador $trabajador): bool
    {
        return $trabajador->delete();
    }

    public function onlyTrashed(): Collection
    {
        return Trabajador::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    }

    public function findTrashedById(int $id): ?Trabajador
    {
        return Trabajador::onlyTrashed()->find($id);
    }

    public function restore(Trabajador $trabajador): bool
    {
        return $trabajador->restore();
    }

    public function forceDelete(Trabajador $trabajador): bool
    {
        return $trabajador->forceDelete();
    }
}
