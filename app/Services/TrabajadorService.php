<?php

namespace App\Services;

use App\Models\Trabajador;
use App\Repositories\TrabajadorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TrabajadorService
{
    public function __construct(
        protected TrabajadorRepositoryInterface $repo
    ) {
    }

    public function listar(): Collection
    {
        return $this->repo->all();
    }

    public function crear(array $data): Trabajador
    {
        return $this->repo->create($data);
    }

    public function actualizar(Trabajador $trabajador, array $data): Trabajador
    {
        return $this->repo->update($trabajador, $data);
    }

    public function eliminar(Trabajador $trabajador): bool
    {
        return $this->repo->delete($trabajador);
    }

    public function listarPapelera(): Collection
    {
        return $this->repo->onlyTrashed();
    }

    public function restaurar(int $id): bool
    {
        $trabajador = $this->repo->findTrashedById($id);

        if (! $trabajador) {
            return false;
        }

        return $this->repo->restore($trabajador);
    }

    public function eliminarDefinitivo(int $id): bool
    {
        $trabajador = $this->repo->findTrashedById($id);

        if (! $trabajador) {
            return false;
        }

        return $this->repo->forceDelete($trabajador);
    }
}
