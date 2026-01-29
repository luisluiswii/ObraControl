<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    public function index()
    {
        $trabajadores = Trabajador::all();
        return view('trabajadores.index', compact('trabajadores'));
    }

    public function create()
    {
        return view('trabajadores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:trabajadores',
            'email' => 'required|email|unique:trabajadores',
            'telefono' => 'required',
            'puesto' => 'required',
            'salario_hora' => 'required|numeric',
        ]);

        Trabajador::create($request->all());

        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador creado correctamente.');
    }

    public function show(Trabajador $trabajador)
    {
        return view('trabajadores.show', compact('trabajador'));
    }

    public function edit(Trabajador $trabajador)
    {
        return view('trabajadores.edit', compact('trabajador'));
    }

    public function update(Request $request, Trabajador $trabajador)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:trabajadores,dni,' . $trabajador->id,
            'email' => 'required|email|unique:trabajadores,email,' . $trabajador->id,
            'telefono' => 'required',
            'puesto' => 'required',
            'salario_hora' => 'required|numeric',
        ]);

        $trabajador->update($request->all());

        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador actualizado correctamente.');
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();

        return redirect()->route('trabajadores.index')
            ->with('success', 'Trabajador eliminado correctamente.');
    }

    // PAPELERA
    public function papelera()
    {
        $trabajadores = Trabajador::onlyTrashed()->get();
        return view('trabajadores.papelera', compact('trabajadores'));
    }

    public function restaurar($id)
    {
        $trabajador = Trabajador::onlyTrashed()->findOrFail($id);
        $trabajador->restore();

        return redirect()->route('trabajadores.papelera')
            ->with('success', 'Trabajador restaurado correctamente.');
    }

    public function eliminarDefinitivo($id)
    {
        $trabajador = Trabajador::onlyTrashed()->findOrFail($id);
        $trabajador->forceDelete();

        return redirect()->route('trabajadores.papelera')
            ->with('success', 'Trabajador eliminado definitivamente.');
    }
}
