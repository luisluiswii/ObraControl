<?php

namespace App\Repositories;

use App\Models\Fichaje;
use Illuminate\Database\Eloquent\Collection;

interface FichajeRepositoryInterface
{
    public function all(): Collection;

    public function abiertas(): Collection;

    public function create(array $data): Fichaje;

    public function find(int $id): ?Fichaje;

    public function update(Fichaje $fichaje, array $data): bool;

    public function delete(Fichaje $fichaje): bool;

    public function jornadas(): Collection;
}
