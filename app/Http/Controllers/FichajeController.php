<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\Trabajador;
use App\Models\Obra;
use Illuminate\Http\Request;

class FichajeController extends Controller
{
    /**
     * Mostrar listado de fichajes + selects para iniciar jornada + jornadas abiertas
     */
    public function index()
    {
        // Todos los fichajes
        $fichajes = Fichaje::with(['trabajador', 'obra'])
            ->orderBy('id', 'desc')
            ->get();

        // Selects para iniciar jornada
        $trabajadores = Trabajador::orderBy('nombre')->get();
        $obras = Obra::orderBy('nombre')->get();

        // Jornadas abiertas ahora mismo
        $abiertas = Fichaje::with(['trabajador', 'obra'])
            ->whereNull('hora_salida')
            ->orderBy('hora_entrada', 'asc')
            ->get();

        return view('fichajes.index', compact('fichajes', 'trabajadores', 'obras', 'abiertas'));
    }

    /**
     * Iniciar una jornada (crear fichaje con hora_entrada)
     */
    public function iniciarJornada(Request $request)
    {
        $request->validate([
            'trabajador_id' => 'required|exists:trabajadores,id',
            'obra_id' => 'required|exists:obras,id',
        ]);

        Fichaje::create([
            'trabajador_id' => $request->trabajador_id,
            'obra_id' => $request->obra_id,
            'fecha' => date('Y-m-d'),
            'hora_entrada' => date('H:i'),
            'hora_salida' => null,
            'horas_trabajadas' => null,
        ]);

        return back()->with('success', 'Jornada iniciada correctamente.');
    }

    /**
     * Finalizar una jornada (actualizar hora_salida y calcular horas)
     */
    public function finalizarJornada($id)
    {
        $fichaje = Fichaje::findOrFail($id);

        // Si ya está cerrada, no hacemos nada
        if ($fichaje->hora_salida) {
            return back()->with('success', 'Esta jornada ya estaba finalizada.');
        }

        $entrada = strtotime($fichaje->hora_entrada);
        $salida = time();

        // Calcular horas trabajadas
        $horas = round(($salida - $entrada) / 3600, 2);

        $fichaje->update([
            'hora_salida' => date('H:i'),
            'horas_trabajadas' => $horas,
        ]);

        return back()->with('success', 'Jornada finalizada correctamente.');
    }

    /**
     * Crear fichaje manual (formulario)
     */
    public function create()
    {
        $trabajadores = Trabajador::orderBy('nombre')->get();
        $obras = Obra::orderBy('nombre')->get();

        return view('fichajes.create', compact('trabajadores', 'obras'));
    }

    /**
     * Guardar fichaje manual
     */
    public function store(Request $request)
    {
        $request->validate([
            'trabajador_id' => 'required|exists:trabajadores,id',
            'obra_id' => 'required|exists:obras,id',
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'hora_salida' => 'nullable',
        ]);

        Fichaje::create($request->all());

        return redirect()->route('fichajes.index')
            ->with('success', 'Fichaje creado correctamente.');
    }

    /**
     * Eliminar fichaje
     */
    public function destroy($id)
    {
        $fichaje = Fichaje::findOrFail($id);
        $fichaje->delete();

        return back()->with('success', 'Fichaje eliminado.');
    }

    /**
     * Panel de jornadas
     */
    public function jornadas()
    {
        $obras = Obra::orderBy('nombre')->get();

        $jornadas = Fichaje::with(['trabajador', 'obra'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora_entrada', 'desc')
            ->get();

        return view('jornadas.index', compact('jornadas', 'obras'));
    }
}
