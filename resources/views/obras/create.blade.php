@extends('adminlte::page')

@section('title', 'Nueva Obra')

@section('content_header')
    <h1>Crear Obra</h1>
@endsection

@section('content')
    <div class="ct-card">
    <form action="{{ route('obras.store') }}" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Adjuntar PDF <span class="text-muted">(opcional)</span></label>
                    <input type="file" name="pdf" class="form-control-file" accept="application/pdf">
                    <small class="form-text text-muted">Solo archivos PDF. Máx. 5MB.</small>
                </div>
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control ct-input">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control ct-input">
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control ct-input">
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control ct-input">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control ct-select">
                <option value="en curso">En curso</option>
                <option value="finalizada">Finalizada</option>
                <option value="pausada">Pausada</option>
            </select>
        </div>

        <button class="btn btn-ct-success"><i class="fas fa-save ct-btn-icon" aria-hidden="true"></i>Guardar</button>
    </form>
    </div>
@endsection
