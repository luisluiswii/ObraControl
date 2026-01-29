@extends('adminlte::page')

@section('title', 'Nueva Obra')

@section('content_header')
    <h1>Crear Obra</h1>
@endsection

@section('content')
    <form action="{{ route('obras.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control">
        </div>

        <div class="mb-3">
            <label>Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control">
        </div>

        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control">
                <option value="en curso">En curso</option>
                <option value="finalizada">Finalizada</option>
                <option value="pausada">Pausada</option>
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
@endsection
