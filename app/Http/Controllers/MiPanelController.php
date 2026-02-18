<?php

namespace App\Http\Controllers;

use App\Models\Fichaje;
use App\Models\Trabajador;
use App\Services\FichajeService;
use Illuminate\Http\Request;

class MiPanelController extends Controller
{
    public function __construct(protected FichajeService $fichajeService)
    {
        $this->middleware('auth');
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();

        // Admin/Superadmin mantiene el dashboard interno existente.
        if ($user->isAdmin()) {
            return view('bienvenido');
        }

        $trabajador = $user->trabajador;

        $jornadaAbierta = null;
        $obrasAsignadas = collect();
        $misFichajes = null;

        if ($trabajador) {
            $obrasAsignadas = $trabajador->obras()->orderBy('nombre')->get();

            $jornadaAbierta = Fichaje::query()
                ->with('obra')
                ->where('trabajador_id', $trabajador->id)
                ->whereNull('hora_salida')
                ->orderByDesc('id')
                ->first();

            $misFichajes = Fichaje::query()
                ->with('obra')
                ->where('trabajador_id', $trabajador->id)
                ->orderByDesc('fecha')
                ->orderByDesc('hora_entrada')
                ->paginate(10);
        }

        return view('mi_panel', compact('user', 'trabajador', 'obrasAsignadas', 'jornadaAbierta', 'misFichajes'));
    }

    public function iniciarMiJornada(Request $request)
    {
        $user = $request->user();

        $trabajador = $user->trabajador;
        if (!$trabajador) {
            return redirect()->route('dashboard')->with('error', 'Tu usuario no está asociado a ningún trabajador (email no coincide).');
        }

        $data = $request->validate([
            'obra_id' => 'required|integer',
        ]);

        $obraId = (int) $data['obra_id'];
        $obraAsignada = $trabajador->obras()->whereKey($obraId)->exists();

        if (!$obraAsignada) {
            return redirect()->route('dashboard')->with('error', 'No tienes esa obra asignada.');
        }

        $yaAbierta = Fichaje::query()
            ->where('trabajador_id', $trabajador->id)
            ->whereNull('hora_salida')
            ->exists();

        if ($yaAbierta) {
            return redirect()->route('dashboard')->with('info', 'Ya tienes una jornada abierta.');
        }

        $this->fichajeService->iniciarJornada($trabajador->id, $obraId);

        return redirect()->route('dashboard')->with('success', 'Jornada iniciada correctamente.');
    }

    public function finalizarMiJornada(Request $request)
    {
        $user = $request->user();

        $trabajador = $user->trabajador;
        if (!$trabajador) {
            return redirect()->route('dashboard')->with('error', 'Tu usuario no está asociado a ningún trabajador (email no coincide).');
        }

        $abierta = Fichaje::query()
            ->where('trabajador_id', $trabajador->id)
            ->whereNull('hora_salida')
            ->orderByDesc('id')
            ->first();

        if (!$abierta) {
            return redirect()->route('dashboard')->with('info', 'No tienes ninguna jornada abierta.');
        }

        $ok = $this->fichajeService->finalizarJornada((int) $abierta->id);

        return redirect()->route('dashboard')->with(
            $ok ? 'success' : 'info',
            $ok ? 'Jornada finalizada correctamente.' : 'Esta jornada ya estaba finalizada.'
        );
    }
}
