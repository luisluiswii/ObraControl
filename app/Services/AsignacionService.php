<?php

namespace App\Services;

use App\Repositories\AsignacionRepositoryInterface;
use Illuminate\Support\Collection;

class AsignacionService
{
    public function __construct(
        protected AsignacionRepositoryInterface $repo
    ) {
    }

    public function listar(): Collection
    {
        return $this->repo->all();
    }

    public function crear(array $data): void
    {
        $this->repo->create($data);
    }

    public function eliminar(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
