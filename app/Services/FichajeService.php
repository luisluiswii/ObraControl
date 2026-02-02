<?php

namespace App\Services;

use App\Models\Fichaje;
use App\Repositories\FichajeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class FichajeService
{
    public function __construct(
        protected FichajeRepositoryInterface $repo
    ) {
    }

    public function listar(): Collection
    {
        return $this->repo->all();
    }

    public function abiertas(): Collection
    {
        return $this->repo->abiertas();
    }

    public function iniciarJornada(int $trabajadorId, int $obraId): Fichaje
    {
        return $this->repo->create([
            'trabajador_id' => $trabajadorId,
            'obra_id' => $obraId,
            'fecha' => now()->toDateString(),
            'hora_entrada' => now()->format('H:i'),
            'hora_salida' => null,
            'horas_trabajadas' => null,
        ]);
    }

    public function finalizarJornada(int $id): bool
    {
        $fichaje = $this->repo->find($id);

        if (! $fichaje || $fichaje->hora_salida) {
            return false;
        }

        $entrada = Carbon::createFromFormat('H:i', $fichaje->hora_entrada);
        $salida = Carbon::now();
        $horas = round($salida->floatDiffInHours($entrada), 2);

        return $this->repo->update($fichaje, [
            'hora_salida' => $salida->format('H:i'),
            'horas_trabajadas' => $horas,
        ]);
    }

    public function crearManual(array $data): Fichaje
    {
        $data['horas_trabajadas'] = $this->calcularHoras($data['hora_entrada'], $data['hora_salida'] ?? null);

        return $this->repo->create($data);
    }

    public function eliminar(int $id): bool
    {
        $fichaje = $this->repo->find($id);

        if (! $fichaje) {
            return false;
        }

        return $this->repo->delete($fichaje);
    }

    public function jornadas(): Collection
    {
        return $this->repo->jornadas();
    }

    protected function calcularHoras(string $horaEntrada, ?string $horaSalida): ?float
    {
        if (! $horaSalida) {
            return null;
        }

        $entrada = Carbon::createFromFormat('H:i', $horaEntrada);
        $salida = Carbon::createFromFormat('H:i', $horaSalida);

        return round($salida->floatDiffInHours($entrada), 2);
    }
}
