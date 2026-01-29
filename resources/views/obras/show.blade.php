@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle de la Obra</h1>

    <h3>{{ $obra->nombre }}</h3>
    <p><strong>Dirección:</strong> {{ $obra->direccion }}</p>
    <p><strong>Fecha inicio:</strong> {{ $obra->fecha_inicio }}</p>
    <p><strong>Fecha fin:</strong> {{ $obra->fecha_fin }}</p>
    <p><strong>Estado:</strong> {{ $obra->estado }}</p>

    <hr>

    <h3>Trabajadores asignados</h3>

    @if($trabajadores->isEmpty())
        <p>No hay trabajadores asignados.</p>
    @else
        <ul>
            @foreach($trabajadores as $t)
                <li>{{ $t->nombre }} {{ $t->apellido }}</li>
            @endforeach
        </ul>
    @endif

    <hr>

    <h3>Todos los trabajadores</h3>
    <ul>
        @foreach($todos as $t)
            <li>{{ $t->nombre }} {{ $t->apellido }}</li>
        @endforeach
    </ul>
</div>
@endsection
