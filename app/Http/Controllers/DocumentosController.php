<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $documentos = Documento::query()
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('documentos.index', compact('documentos'));
    }

    public function create()
    {
        return view('documentos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp,gif|max:10240',
            'redirect_to' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('documentos', 'public');
        }

        Documento::create([
            'user_id' => auth()->id(),
            'nombre' => $data['nombre'],
            'descripcion' => $data['descripcion'] ?? null,
            'archivo_pdf' => $path,
        ]);

        $redirectTo = $data['redirect_to'] ?? route('documentos.index');

        return redirect($redirectTo)->with('success', 'Documento creado correctamente.');
    }

    public function destroy(Documento $documento)
    {
        $user = auth()->user();

        $isOwner = (int) $documento->user_id === (int) $user->id;
        $canDeleteAny = $user->canDeleteBackups();

        if (!$isOwner && !$canDeleteAny) {
            return redirect()->route('documentos.index')->with('error', 'No tienes permisos para eliminar este documento.');
        }

        if ($documento->archivo_pdf) {
            Storage::disk('public')->delete($documento->archivo_pdf);
        }

        $documento->delete();

        return redirect()->back()->with('success', 'Documento eliminado correctamente.');
    }
}
