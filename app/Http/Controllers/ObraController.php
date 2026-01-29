<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Trabajador;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    /* ============================================================
       LISTADO PRINCIPAL
    ============================================================ */
    public function index()
    {
        $obras = Obra::all();
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
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        Obra::create($request->all());

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
    public function update(Request $request, Obra $obra)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
        ]);

        $obra->update($request->all());

        return redirect()->route('obras.index')
                         ->with('success', 'Obra actualizada correctamente');
    }

    /* ============================================================
       ELIMINAR (ENVÍA A PAPELERA)
    ============================================================ */
    public function destroy(Obra $obra)
    {
        $obra->delete();

        return redirect()->route('obras.index')
                         ->with('success', 'Obra enviada a la papelera');
    }

    /* ============================================================
       PAPELERA (SOLO TRASHED)
    ============================================================ */
    public function papelera()
    {
        $obras = Obra::onlyTrashed()->get();
        return view('obras.papelera', compact('obras'));
    }

    /* ============================================================
       RESTAURAR DESDE PAPELERA
    ============================================================ */
    public function restaurar($id)
    {
        $obra = Obra::onlyTrashed()->where('id', $id)->firstOrFail();
        $obra->restore();

        return redirect()->route('obras.papelera')
                         ->with('success', 'Obra restaurada correctamente');
    }

    /* ============================================================
       ELIMINAR DEFINITIVO
    ============================================================ */
    public function eliminarDefinitivo($id)
    {
        $obra = Obra::onlyTrashed()->where('id', $id)->firstOrFail();
        $obra->forceDelete();

        return redirect()->route('obras.papelera')
                         ->with('success', 'Obra eliminada definitivamente');
    }

    /* ============================================================
       ASIGNAR TRABAJADOR A OBRA
    ============================================================ */
    public function asignar(Request $request, Obra $obra)
    {
        $request->validate([
            'trabajador_id' => 'required|exists:trabajadors,id',
        ]);

        $obra->trabajadores()->attach($request->trabajador_id);

        return redirect()->route('obras.show', $obra->id)
                         ->with('success', 'Trabajador asignado correctamente');
    }

    /* ============================================================
       QUITAR TRABAJADOR DE OBRA
    ============================================================ */
    public function quitarTrabajador(Obra $obra, Trabajador $trabajador)
    {
        $obra->trabajadores()->detach($trabajador->id);

        return redirect()->route('obras.show', $obra->id)
                         ->with('success', 'Trabajador eliminado de la obra');
    }
}
