<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = DB::table('obra_trabajador')
            ->join('obras', 'obras.id', '=', 'obra_trabajador.obra_id')
            ->join('trabajadores', 'trabajadores.id', '=', 'obra_trabajador.trabajador_id')
            ->select(
                'obra_trabajador.*',
                'obras.nombre as obra_nombre',
                'trabajadores.nombre as trabajador_nombre',
                'trabajadores.apellido as trabajador_apellido'
            )
            ->get();

        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $obras = Obra::all();
        $trabajadores = Trabajador::all();

        return view('asignaciones.create', compact('obras', 'trabajadores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'obra_id' => 'required',
            'trabajador_id' => 'required',
            'fecha_asignacion' => 'required|date',
        ]);

        DB::table('obra_trabajador')->insert([
            'obra_id' => $request->obra_id,
            'trabajador_id' => $request->trabajador_id,
            'fecha_asignacion' => $request->fecha_asignacion,
            'fecha_fin' => $request->fecha_fin,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación creada correctamente.');
    }

    public function destroy($id)
    {
        DB::table('obra_trabajador')->where('id', $id)->delete();

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación eliminada.');
    }
}
