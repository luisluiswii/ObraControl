@extends('adminlte::page')

@section('title', 'Nueva Asignación')

@section('content_header')
    <h1>Nueva Asignación</h1>
@endsection

@section('content')

<form action="{{ route('asignaciones.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Obra</label>
        <select name="obra_id" class="form-control">
            @foreach ($obras as $obra)
                <option value="{{ $obra->id }}">{{ $obra->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Trabajador</label>
        <select name="trabajador_id" class="form-control">
            @foreach ($trabajadores as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fecha de Asignación</label>
        <input type="date" name="fecha_asignacion" class="form-control">
    </div>

    <div class="form-group">
        <label>Fecha de Fin (opcional)</label>
        <input type="date" name="fecha_fin" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
