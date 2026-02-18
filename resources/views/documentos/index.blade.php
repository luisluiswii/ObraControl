@extends('adminlte::page')

@section('title', 'Documentos')

@section('content_header')
    <h1>Mis Documentos</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="ct-section-header mb-3">
        <h2 class="ct-section-title">Mis documentos</h2>
        <a href="{{ route('documentos.create') }}" class="btn btn-ct-success btn-lg shadow-sm"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Nuevo documento</a>
    </div>

    <div class="ct-grid ct-grid-2">
        @forelse ($documentos as $documento)
            <div class="ct-card ct-card-ct d-flex flex-column justify-content-between p-4">
                <div class="mb-2">
                    <div class="fw-bold fs-5">{{ $documento->nombre }}</div>
                    <div class="ct-muted fs-6 mb-1">Subido: {{ optional($documento->created_at)->format('d/m/Y H:i') }}</div>
                    @if($documento->descripcion)
                        <div class="mb-2">{{ $documento->descripcion }}</div>
                    @endif
                </div>

                <div class="d-flex gap-2 align-items-center mt-auto">
                    @if($documento->archivo_pdf)
                        <a href="{{ asset('storage/' . $documento->archivo_pdf) }}"
                           target="_blank"
                           class="btn btn-ct-secondary btn-lg ct-btn-icon-only"
                           title="Ver archivo"
                           aria-label="Ver archivo">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </a>
                    @else
                        <span class="ct-pill">Sin archivo</span>
                    @endif

                    <form action="{{ route('documentos.destroy', $documento) }}" method="POST" style="display:inline" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-ct-danger btn-lg ct-btn-icon-only"
                                type="submit"
                                title="Eliminar"
                                aria-label="Eliminar"
                                onclick="return confirm('¿Eliminar documento?')">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="ct-card p-4">
                <div class="ct-muted">Aún no has subido documentos.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $documentos->links() }}
    </div>
@endsection
