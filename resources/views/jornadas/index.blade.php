@extends('adminlte::page')

@section('title', 'Jornadas')

@section('content_header')
    <h1>Jornadas</h1>
@endsection

@section('content')

<table class="table table-bordered table-striped ct-table">
    <thead>
        <tr>
            <th>Trabajador</th>
            <th>Obra</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Horas</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($jornadas as $j)
            <tr>
                <td>{{ $j->trabajador->nombre }} {{ $j->trabajador->apellido }}</td>
                <td>{{ $j->obra->nombre }}</td>
                <td>{{ $j->fecha }}</td>
                <td>{{ $j->hora_entrada }}</td>
                <td>{{ $j->hora_salida ?? '—' }}</td>
                <td>{{ $j->horas_trabajadas ?? '—' }}</td>

                <td>
                    @if(!$j->hora_salida)
                        <form action="{{ route('jornadas.finalizar', $j->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-ct-warning btn-sm">Finalizar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
