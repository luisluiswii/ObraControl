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

    public function listar($perPage = 10)
    {
        return $this->repo->paginate($perPage);
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
