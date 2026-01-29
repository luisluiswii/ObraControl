@extends('adminlte::page')

@section('title', 'Fichajes')

@section('content_header')
    <h1>Fichajes</h1>
@endsection

@section('content')

{{-- FORMULARIO PARA INICIAR JORNADA --}}
<div class="card mb-4">
    <div class="card-body">

        <form action="{{ route('jornadas.iniciar') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-4">
                    <label>Trabajador</label>
                    <select name="trabajador_id" class="form-control" required>
                        @foreach($trabajadores as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->nombre }} {{ $t->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Obra</label>
                    <select name="obra_id" class="form-control" required>
                        @foreach($obras as $o)
                            <option value="{{ $o->id }}">
                                {{ $o->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success w-100">
                        Iniciar jornada
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<a href="{{ route('fichajes.create') }}" class="btn btn-primary mb-3">Nuevo Fichaje</a>

<table class="table table-bordered table-striped">
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
        @foreach ($fichajes as $f)
            <tr>
                <td>{{ $f->trabajador->nombre }} {{ $f->trabajador->apellido }}</td>
                <td>{{ $f->obra->nombre }}</td>
                <td>{{ $f->fecha }}</td>
                <td>{{ $f->hora_entrada }}</td>
                <td>{{ $f->hora_salida ?? '—' }}</td>
                <td>{{ $f->horas_trabajadas ?? '—' }}</td>

                <td>

                    {{-- FINALIZAR JORNADA --}}
                    @if(!$f->hora_salida)
                        <form action="{{ route('jornadas.finalizar', $f->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-warning btn-sm">
                                Finalizar
                            </button>
                        </form>
                    @endif

                    {{-- ELIMINAR --}}
                    <form action="{{ route('fichajes.destroy', $f->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
