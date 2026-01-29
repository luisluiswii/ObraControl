@extends('adminlte::page')

@section('title', 'Asignaciones')

@section('content_header')
    <h1>Asignaciones</h1>
@endsection

@section('content')

<a href="{{ route('asignaciones.create') }}" class="btn btn-primary mb-3">Nueva Asignación</a>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Obra</th>
            <th>Trabajador</th>
            <th>Fecha Asignación</th>
            <th>Fecha Fin</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($asignaciones as $a)
            <tr>
                <td>{{ $a->obra_nombre }}</td>
                <td>{{ $a->trabajador_nombre }} {{ $a->trabajador_apellido }}</td>
                <td>{{ $a->fecha_asignacion }}</td>
                <td>{{ $a->fecha_fin ?? 'Activa' }}</td>

                <td>
                    <form action="{{ route('asignaciones.destroy', $a->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
