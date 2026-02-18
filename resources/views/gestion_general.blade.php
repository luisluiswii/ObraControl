@extends('adminlte::page')

@section('title', 'Gestión General')

@section('content_header')
    <h1>Panel de Gestión General</h1>
@endsection

@section('content')
<div class="ct-app">
    <div class="ct-dashboard">
        <div class="ct-grid">
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-primary"><i class="fas fa-building"></i></div>
                <div>
                    <div class="ct-kpi-label">Obras activas</div>
                    <div class="ct-kpi-value">{{ $obrasCount }}</div>
                    <a class="ct-link" href="{{ route('obras.index') }}">Ver obras</a>
                </div>
            </div>
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-success"><i class="fas fa-users"></i></div>
                <div>
                    <div class="ct-kpi-label">Empleados</div>
                    <div class="ct-kpi-value">{{ $trabajadoresCount }}</div>
                    <a class="ct-link" href="{{ route('trabajadores.index') }}">Ver empleados</a>
                </div>
            </div>
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-warning"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="ct-kpi-label">Fichajes hoy</div>
                    <div class="ct-kpi-value">{{ $fichajesHoy }}</div>
                    <a class="ct-link" href="{{ route('fichajes.index') }}">Historial</a>
                </div>
            </div>
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-accent"><i class="fas fa-play-circle"></i></div>
                <div>
                    <div class="ct-kpi-label">Jornadas abiertas</div>
                    <div class="ct-kpi-value">{{ $jornadasAbiertas }}</div>
                    <a class="ct-link" href="{{ route('jornadas.index') }}">Ver jornadas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
