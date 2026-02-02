<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Trabajador;
use App\Http\Requests\Obras\StoreObraRequest;
use App\Http\Requests\Obras\UpdateObraRequest;
use App\Services\ObraService;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function __construct(
        protected ObraService $service
    ) {
    }
    /* ============================================================
       LISTADO PRINCIPAL
    ============================================================ */
    public function index()
    {
        $obras = $this->service->listar();
        return view('obras.index', compact('obras'));
    }

    /* ============================================================
       FORMULARIO CREAR
    ============================================================ */
    public function create()
    {
        return view('obras.create');
    }

    /* ============================================================
       GUARDAR NUEVA OBRA
    ============================================================ */
    public function store(StoreObraRequest $request)
    {
        $this->service->crear($request->validated());

        return redirect()->route('obras.index')
                         ->with('success', 'Obra creada correctamente');
    }

    /* ============================================================
       MOSTRAR OBRA
    ============================================================ */
    public function show(Obra $obra)
    {
        $trabajadores = $obra->trabajadores;
        $todos = Trabajador::all();

        return view('obras.show', compact('obra', 'trabajadores', 'todos'));
    }

    /* ============================================================
       FORMULARIO EDITAR
    ============================================================ */
    public function edit(Obra $obra)
    {
        return view('obras.edit', compact('obra'));
    }

    /* ============================================================
       ACTUALIZAR OBRA
    ============================================================ */
    public function update(UpdateObraRequest $request, Obra $obra)
    {
        $this->service->actualizar($obra, $request->validated());

        return redirect()->route('obras.index')
                         ->with('success', 'Obra actualizada correctamente');
    }

    /* ============================================================
       ELIMINAR (ENVÍA A PAPELERA)
    ============================================================ */
    public function destroy(Obra $obra)
    {
        $this->service->eliminar($obra);

        return redirect()->route('obras.index')
                         ->with('success', 'Obra enviada a la papelera');
    }

    /* ============================================================
       PAPELERA (SOLO TRASHED)
    ============================================================ */
    public function papelera()
    {
        $obras = $this->service->listarPapelera();
        return view('obras.papelera', compact('obras'));
    }

    /* ============================================================
       RESTAURAR DESDE PAPELERA
    ============================================================ */
    public function restaurar($id)
    {
        $restaurado = $this->service->restaurar((int) $id);

        return redirect()->route('obras.papelera')
                         ->with(
                             $restaurado ? 'success' : 'error',
                             $restaurado
                                 ? 'Obra restaurada correctamente'
                                 : 'No se pudo restaurar la obra'
                         );
    }

    /* ============================================================
       ELIMINAR DEFINITIVO
    ============================================================ */
    public function eliminarDefinitivo($id)
    {
        $eliminada = $this->service->eliminarDefinitivo((int) $id);

        return redirect()->route('obras.papelera')
                         ->with(
                             $eliminada ? 'success' : 'error',
                             $eliminada
                                 ? 'Obra eliminada definitivamente'
                                 : 'No se pudo eliminar la obra'
                         );
    }

    /* ============================================================
       ASIGNAR TRABAJADOR A OBRA
    ============================================================ */
    public function asignar(Request $request, Obra $obra)
    {
        $request->validate([
            'trabajador_id' => 'required|exists:trabajadores,id',
        ]);

        $this->service->asignarTrabajador($obra, (int) $request->trabajador_id);

        return redirect()->route('obras.show', $obra->id)
                         ->with('success', 'Trabajador asignado correctamente');
    }

    /* ============================================================
       QUITAR TRABAJADOR DE OBRA
    ============================================================ */
    public function quitarTrabajador(Obra $obra, Trabajador $trabajador)
    {
        $this->service->quitarTrabajador($obra, (int) $trabajador->id);

        return redirect()->route('obras.show', $obra->id)
                         ->with('success', 'Trabajador eliminado de la obra');
    }
}
