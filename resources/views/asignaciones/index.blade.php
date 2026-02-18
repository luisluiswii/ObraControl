@extends('adminlte::page')

@section('title', 'Asignaciones')

@section('content_header')
    <h1>Asignaciones</h1>
@endsection

@section('content')


<div class="ct-section-header mb-3">
    <h2 class="ct-section-title">Listado de Asignaciones</h2>
    <a href="{{ route('asignaciones.create') }}" class="btn btn-ct-success btn-lg shadow-sm"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Nueva Asignación</a>
</div>
<div class="ct-grid ct-grid-2">
    @foreach ($asignaciones as $a)
        <div class="ct-card d-flex flex-column justify-content-between p-4">
            <div class="mb-2">
                <div class="fw-bold fs-5">{{ $a->obra_nombre }}</div>
                <div class="ct-muted fs-6 mb-1">{{ $a->trabajador_nombre }} {{ $a->trabajador_apellido }}</div>
                <div class="mb-2">Asignado: {{ $a->fecha_asignacion }}</div>
            </div>
            <div class="mb-2">
                <span class="ct-pill ct-pill-ct me-2"><i class="fas fa-calendar-check"></i> {{ $a->fecha_fin ?? 'Activa' }}</span>
            </div>
            <div class="d-flex gap-2 align-items-center mt-auto">
                <form action="{{ route('asignaciones.destroy', $a->id) }}" method="POST" class="flex-fill" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-ct-danger btn-lg w-100"><i class="fas fa-trash ct-btn-icon" aria-hidden="true"></i>Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-4">
    {{ $asignaciones->links('vendor.pagination.default') }}
</div>

@endsection
