@extends('adminlte::page')

@section('title', 'Nueva Asignación')

@section('content_header')
    <h1>Nueva Asignación</h1>
@endsection

@section('content')

<div class="ct-card">
<form action="{{ route('asignaciones.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Obra</label>
        <select name="obra_id" class="form-control ct-select">
            @foreach ($obras as $obra)
                <option value="{{ $obra->id }}">{{ $obra->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Trabajador</label>
        <select name="trabajador_id" class="form-control ct-select">
            @foreach ($trabajadores as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fecha de Asignación</label>
        <input type="date" name="fecha_asignacion" class="form-control ct-input">
    </div>

    <div class="form-group">
        <label>Fecha de Fin (opcional)</label>
        <input type="date" name="fecha_fin" class="form-control ct-input">
    </div>

    <button class="btn btn-ct-success">Guardar</button>
</form>

</div>

@endsection
