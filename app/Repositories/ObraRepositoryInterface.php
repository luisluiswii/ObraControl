<?php

namespace App\Repositories;

use App\Models\Obra;
use Illuminate\Database\Eloquent\Collection;

interface ObraRepositoryInterface
{
    public function paginate($perPage = 10);
    public function onlyTrashedPaginate($perPage = 10);
    public function all(): Collection;

    public function create(array $data): Obra;

    public function update(Obra $obra, array $data): Obra;

    public function delete(Obra $obra): bool;

    public function onlyTrashed(): Collection;

    public function findTrashedById(int $id): ?Obra;

    public function restore(Obra $obra): bool;

    public function forceDelete(Obra $obra): bool;
}
