<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AsignacionRepositoryInterface
{
    public function all(): Collection;
    public function paginate($perPage = 10);
    public function create(array $data): void;
    public function delete(int $id): bool;
}
