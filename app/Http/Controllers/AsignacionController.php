<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Trabajador;
use App\Services\AsignacionService;
use App\Http\Requests\Asignaciones\StoreAsignacionRequest;

class AsignacionController extends Controller
{
    public function __construct(
        protected AsignacionService $service
    ) {
    }

    public function index(\Illuminate\Http\Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $asignaciones = $this->service->listar($perPage);
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $obras = Obra::all();
        $trabajadores = Trabajador::all();

        return view('asignaciones.create', compact('obras', 'trabajadores'));
    }

    public function store(StoreAsignacionRequest $request)
    {
        $this->service->crear($request->validated());

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación creada correctamente.');
    }

    public function destroy($id)
    {
        $eliminada = $this->service->eliminar((int) $id);

        return redirect()->route('asignaciones.index')
            ->with(
                $eliminada ? 'success' : 'error',
                $eliminada
                    ? 'Asignación eliminada.'
                    : 'No se pudo eliminar la asignación.'
            );
    }
}
