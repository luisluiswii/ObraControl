@extends('adminlte::page')

@section('title', 'Editar Obra')

@section('content_header')
    <h1>Editar Obra</h1>
@endsection

@section('content')
    <div class="ct-card">
    <form action="{{ route('obras.update', $obra) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control ct-input" value="{{ $obra->nombre }}">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control ct-input" value="{{ $obra->direccion }}">
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control ct-input" value="{{ $obra->fecha_inicio }}">
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control ct-input" value="{{ $obra->fecha_fin }}">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control ct-select">
                <option value="en curso" {{ $obra->estado == 'en curso' ? 'selected' : '' }}>En curso</option>
                <option value="finalizada" {{ $obra->estado == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
                <option value="pausada" {{ $obra->estado == 'pausada' ? 'selected' : '' }}>Pausada</option>
            </select>
        </div>

        <button class="btn btn-ct-success">Actualizar</button>
    </form>
    </div>
@endsection
