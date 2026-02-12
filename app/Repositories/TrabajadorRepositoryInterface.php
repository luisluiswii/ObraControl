    public function paginate($perPage = 10);
<?php

namespace App\Repositories;

use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Collection;

interface TrabajadorRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): Trabajador;

    public function update(Trabajador $trabajador, array $data): Trabajador;

    public function delete(Trabajador $trabajador): bool;

    public function onlyTrashed(): Collection;

    public function findTrashedById(int $id): ?Trabajador;

    public function restore(Trabajador $trabajador): bool;

    public function forceDelete(Trabajador $trabajador): bool;
}
