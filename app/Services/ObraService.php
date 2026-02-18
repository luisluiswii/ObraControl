<?php

namespace App\Services;

use App\Models\Obra;
use App\Repositories\ObraRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ObraService
{
    public function __construct(
        protected ObraRepositoryInterface $repo
    ) {
    }

    public function listar($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    public function crear(array $data): Obra
    {
        // El controlador ya maneja el almacenamiento del PDF y pasa la ruta en $data['pdf'] si existe
        return $this->repo->create($data);
    }

    public function actualizar(Obra $obra, array $data): Obra
    {
        // El controlador ya maneja el almacenamiento del PDF y pasa la ruta en $data['pdf'] si existe
        return $this->repo->update($obra, $data);
    }

    public function eliminar(Obra $obra): bool
    {
        return $this->repo->delete($obra);
    }

    public function listarPapelera($perPage = 10)
    {
        return $this->repo->onlyTrashedPaginate($perPage);
    }

    public function restaurar(int $id): bool
    {
        $obra = $this->repo->findTrashedById($id);

        if (! $obra) {
            return false;
        }

        return $this->repo->restore($obra);
    }

    public function eliminarDefinitivo(int $id): bool
    {
        $obra = $this->repo->findTrashedById($id);

        if (! $obra) {
            return false;
        }

        return $this->repo->forceDelete($obra);
    }

    public function asignarTrabajador(Obra $obra, int $trabajadorId): void
    {
        $obra->trabajadores()->attach($trabajadorId);
    }

    public function quitarTrabajador(Obra $obra, int $trabajadorId): void
    {
        $obra->trabajadores()->detach($trabajadorId);
    }
}
