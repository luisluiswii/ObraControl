<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Services\TrabajadorService;
use App\Services\TrabajadorUserSyncService;
use App\Http\Requests\Trabajadores\StoreTrabajadorRequest;
use App\Http\Requests\Trabajadores\UpdateTrabajadorRequest;

class TrabajadorController extends Controller
{
    public function __construct(
        protected TrabajadorService $service,
        protected TrabajadorUserSyncService $userSync
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
        $trabajador = $this->service->crear($data);

        $sync = $this->userSync->ensureUserForTrabajador($trabajador);

        $message = 'Trabajador creado correctamente.';
        if (($sync['created'] ?? false) && isset($sync['password'])) {
            $message .= ' Usuario creado (rol usuario). Contraseña inicial: ' . $sync['password'];
        }

        return redirect()->route('trabajadores.index')->with('success', $message);
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
        $updated = $this->service->actualizar($trabajador, $data);

        // Si no estaba vinculado aún, intenta vincular/crear.
        $sync = $this->userSync->ensureUserForTrabajador($updated);

        // Si ya está vinculado, sincroniza email.
        $this->userSync->syncUserEmailFromTrabajador($updated);

        $message = 'Trabajador actualizado correctamente.';
        if (($sync['created'] ?? false) && isset($sync['password'])) {
            $message .= ' Usuario creado (rol usuario). Contraseña inicial: ' . $sync['password'];
        }

        return redirect()->route('trabajadores.index')->with('success', $message);
    }

    public function destroy(Trabajador $trabajador)
    {
        $this->service->eliminar($trabajador);
        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador eliminado.');
    }

    public function papelera(\Illuminate\Http\Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $trabajadores = $this->service->listarPapelera($perPage);
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
