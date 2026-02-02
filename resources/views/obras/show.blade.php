@extends('adminlte::page')

@section('title', 'Detalle de la Obra')

@section('content_header')
    <h1>Detalle de la obra</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 mb-3">
        <div class="ct-card">
            <h2 class="ct-section-title">{{ $obra->nombre }}</h2>
            <p><strong>Dirección:</strong> {{ $obra->direccion }}</p>
            <p><strong>Fecha inicio:</strong> {{ $obra->fecha_inicio }}</p>
            <p><strong>Fecha fin:</strong> {{ $obra->fecha_fin ?? '—' }}</p>
            <p><strong>Estado:</strong> {{ $obra->estado }}</p>
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="ct-card">
            <h2 class="ct-section-title">Trabajadores asignados</h2>
            @if($trabajadores->isEmpty())
                <p class="text-muted">No hay trabajadores asignados.</p>
            @else
                <ul class="pl-3">
                    @foreach($trabajadores as $t)
                        <li>{{ $t->nombre }} {{ $t->apellido }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="ct-card">
            <h2 class="ct-section-title">Todos los trabajadores</h2>
            <div class="row">
                @foreach($todos as $t)
                    <div class="col-md-4 col-lg-3 mb-2">
                        <div class="ct-pill"><i class="fas fa-user"></i> {{ $t->nombre }} {{ $t->apellido }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
