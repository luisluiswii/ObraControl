@extends('adminlte::page')

@section('title', 'Nuevo Fichaje')

@section('content_header')
    <h1>Nuevo Fichaje</h1>
@endsection

@section('content')

<div class="ct-card">
<form action="{{ route('fichajes.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Trabajador</label>
        <select name="trabajador_id" class="form-control ct-select">
            @foreach ($trabajadores as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Obra</label>
        <select name="obra_id" class="form-control ct-select">
            @foreach ($obras as $o)
                <option value="{{ $o->id }}">{{ $o->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fecha</label>
        <input type="date" name="fecha" class="form-control ct-input">
    </div>

    <div class="form-group">
        <label>Hora Entrada</label>
        <input type="time" name="hora_entrada" class="form-control ct-input">
    </div>

    <div class="form-group">
        <label>Hora Salida (opcional)</label>
        <input type="time" name="hora_salida" class="form-control ct-input">
    </div>

    <button class="btn btn-ct-success">Guardar</button>
</form>

</div>

@endsection
