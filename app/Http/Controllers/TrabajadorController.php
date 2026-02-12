<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Services\TrabajadorService;
use App\Http\Requests\Trabajadores\StoreTrabajadorRequest;
use App\Http\Requests\Trabajadores\UpdateTrabajadorRequest;

class TrabajadorController extends Controller
{
    public function __construct(
        protected TrabajadorService $service
    ) {
    }

    public function index()
    {
        $trabajadores = $this->service->listarPaginado();
        return view('trabajadores.index', compact('trabajadores'));
    }

    public function create()
    {
        return view('trabajadores.create');
    }

    public function store(StoreTrabajadorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('trabajadores', 'public');
        }
        $this->service->crear($data);
        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador creado correctamente.');
    }

    public function edit(Trabajador $trabajador)
    {
        return view('trabajadores.edit', compact('trabajador'));
    }

    public function update(UpdateTrabajadorRequest $request, Trabajador $trabajador)
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('trabajadores', 'public');
        }
        $this->service->actualizar($trabajador, $data);
        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador actualizado correctamente.');
    }

    public function destroy(Trabajador $trabajador)
    {
        $this->service->eliminar($trabajador);
        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador eliminado.');
    }

    public function papelera()
    {
        $trabajadores = $this->service->listarPapelera();

        return view('trabajadores.papelera', compact('trabajadores'));
    }

    public function restaurar($trabajador)
    {
        $restaurado = $this->service->restaurar((int) $trabajador);

        return redirect()->route('trabajadores.papelera')
            ->with(
                $restaurado ? 'success' : 'error',
                $restaurado
                    ? 'Trabajador restaurado correctamente.'
                    : 'No se pudo restaurar el trabajador.'
            );
    }

    public function eliminarDefinitivo($trabajador)
    {
        $eliminado = $this->service->eliminarDefinitivo((int) $trabajador);

        return redirect()->route('trabajadores.papelera')
            ->with(
                $eliminado ? 'success' : 'error',
                $eliminado
                    ? 'Trabajador eliminado definitivamente.'
                    : 'No se pudo eliminar el trabajador.'
            );
    }
}
