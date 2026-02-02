<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

interface AsignacionRepositoryInterface
{
    public function all(): Collection;

    public function create(array $data): void;

    public function delete(int $id): bool;
}
