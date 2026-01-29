@extends('adminlte::page')

@section('title', 'Asignar Trabajadores')

@section('content_header')
    <h1>Asignar Trabajadores a la Obra: {{ $obra->nombre }}</h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<h3>Asignar nuevo trabajador</h3>

<form action="{{ route('obras.guardarAsignacion', $obra) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Trabajador</label>
        <select name="trabajador_id" class="form-control">
            @foreach($trabajadores as $t)
                <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Fecha de asignación</label>
        <input type="date" name="fecha_asignacion" class="form-control" value="{{ date('Y-m-d') }}">
    </div>

    <button class="btn btn-primary">Asignar</button>
</form>

<hr>

<h3>Trabajadores asignados</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Trabajador</th>
            <th>Fecha asignación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($obra->trabajadores as $t)
            <tr>
                <td>{{ $t->nombre }} {{ $t->apellido }}</td>
                <td>{{ $t->pivot->fecha_asignacion }}</td>
                <td>
                    <form action="{{ route('obras.quitarTrabajador', [$obra, $t->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Quitar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
