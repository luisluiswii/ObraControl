@extends('adminlte::page')

@section('title', 'Nuevo Fichaje')

@section('content_header')
    <h1>Nuevo Fichaje</h1>
@endsection

@section('content')

<form action="{{ route('fichajes.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Trabajador</label>
        <select name="trabajador_id" class="form-control">
            @foreach ($trabajadores as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Obra</label>
        <select name="obra_id" class="form-control">
            @foreach ($obras as $o)
                <option value="{{ $o->id }}">{{ $o->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Fecha</label>
        <input type="date" name="fecha" class="form-control">
    </div>

    <div class="form-group">
        <label>Hora Entrada</label>
        <input type="time" name="hora_entrada" class="form-control">
    </div>

    <div class="form-group">
        <label>Hora Salida (opcional)</label>
        <input type="time" name="hora_salida" class="form-control">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

@endsection
