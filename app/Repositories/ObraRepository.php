<?php

namespace App\Repositories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Collection;

class ObraRepository implements ObraRepositoryInterface
{
    public function all(): Collection
    {
        return Obra::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data): Obra
    {
        return Obra::create($data);
    }

    public function update(Obra $obra, array $data): Obra
    {
        $obra->update($data);

        return $obra;
    }

    public function delete(Obra $obra): bool
    {
        return $obra->delete();
    }

    public function onlyTrashed(): Collection
    {
        return Obra::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    }

    public function findTrashedById(int $id): ?Obra
    {
        return Obra::onlyTrashed()->find($id);
    }

    public function restore(Obra $obra): bool
    {
        return $obra->restore();
    }

    public function forceDelete(Obra $obra): bool
    {
        return $obra->forceDelete();
    }
}
