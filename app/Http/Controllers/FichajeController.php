<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\Trabajador;
use App\Models\Obra;
use App\Services\FichajeService;
use App\Http\Requests\Fichajes\IniciarJornadaRequest;
use App\Http\Requests\Fichajes\StoreFichajeRequest;

class FichajeController extends Controller
{
    public function __construct(
        protected FichajeService $service
    ) {
    }

    /**
     * Mostrar listado de fichajes + selects para iniciar jornada + jornadas abiertas
     */
    public function index()
    {
        // Todos los fichajes
        $fichajes = $this->service->listar();

        // Selects para iniciar jornada
        $trabajadores = Trabajador::orderBy('nombre')->get();
        $obras = Obra::orderBy('nombre')->get();

        // Jornadas abiertas ahora mismo
        $abiertas = $this->service->abiertas();

        return view('fichajes.index', compact('fichajes', 'trabajadores', 'obras', 'abiertas'));
    }

    /**
     * Iniciar una jornada (crear fichaje con hora_entrada)
     */
    public function iniciarJornada(IniciarJornadaRequest $request)
    {
        $this->service->iniciarJornada(
            (int) $request->trabajador_id,
            (int) $request->obra_id
        );

        return back()->with('success', 'Jornada iniciada correctamente.');
    }

    /**
     * Finalizar una jornada (actualizar hora_salida y calcular horas)
     */
    public function finalizarJornada($id)
    {
        $finalizada = $this->service->finalizarJornada((int) $id);

        return back()->with(
            $finalizada ? 'success' : 'info',
            $finalizada
                ? 'Jornada finalizada correctamente.'
                : 'Esta jornada ya estaba finalizada.'
        );
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
    public function store(StoreFichajeRequest $request)
    {
        $this->service->crearManual($request->validated());

        return redirect()->route('fichajes.index')
            ->with('success', 'Fichaje creado correctamente.');
    }

    /**
     * Eliminar fichaje
     */
    public function destroy($id)
    {
        $eliminado = $this->service->eliminar((int) $id);

        return back()->with(
            $eliminado ? 'success' : 'error',
            $eliminado
                ? 'Fichaje eliminado.'
                : 'No se pudo eliminar el fichaje.'
        );
    }

    /**
     * Panel de jornadas
     */
    public function jornadas()
    {
        $obras = Obra::orderBy('nombre')->get();

        $jornadas = $this->service->jornadas();

        return view('jornadas.index', compact('jornadas', 'obras'));
    }
}
