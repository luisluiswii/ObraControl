@extends('adminlte::page')

@section('title', 'ClearTime')

@section('content_header')
    <div class="ct-hero">
        <div>
            <h1>ClearTime</h1>
            <p>CRM de control horario con claridad, rapidez y foco en las personas.</p>
        </div>
        <div class="ct-hero-badge">Tiempo claro, gestión clara</div>
    </div>
@stop

@section('content')
<div class="ct-app">
    <div class="ct-dashboard">
        <div class="ct-grid">
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-primary">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <div class="ct-kpi-label">Obras activas</div>
                    <div class="ct-kpi-value">{{ $obrasCount }}</div>
                    <a class="ct-link" href="{{ route('obras.index') }}">Ver obras</a>
                </div>
            </div>

            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-success">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="ct-kpi-label">Empleados</div>
                    <div class="ct-kpi-value">{{ $trabajadoresCount }}</div>
                    <a class="ct-link" href="{{ route('trabajadores.index') }}">Ver empleados</a>
                </div>
            </div>

            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="ct-kpi-label">Fichajes hoy</div>
                    <div class="ct-kpi-value">{{ $fichajesHoy }}</div>
                    <a class="ct-link" href="{{ route('fichajes.index') }}">Historial</a>
                </div>
            </div>

            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-accent">
                    <i class="fas fa-play-circle"></i>
                </div>
                <div>
                    <div class="ct-kpi-label">Jornadas abiertas</div>
                    <div class="ct-kpi-value">{{ $jornadasAbiertas }}</div>
                    <a class="ct-link" href="{{ route('jornadas.index') }}">Ver jornadas</a>
                </div>
            </div>
        </div>

        <div class="ct-grid ct-grid-2">
            <div class="ct-card ct-section">
                <div class="ct-section-header">
                    <h2 class="ct-section-title">Fichaje rápido</h2>
                    <span class="ct-pill"><i class="fas fa-bolt"></i> 2 clics · < 5s</span>
                </div>

                @auth
                    <form action="{{ route('jornadas.iniciar') }}" method="POST">
                        @csrf
                        <div class="ct-grid">
                            <div>
                                <label>Empleado</label>
                                <select name="trabajador_id" class="form-control ct-select" required>
                                    @foreach ($trabajadores as $t)
                                        <option value="{{ $t->id }}">{{ $t->nombre }} {{ $t->apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label>Centro / Obra</label>
                                <select name="obra_id" class="form-control ct-select" required>
                                    @foreach ($obras as $o)
                                        <option value="{{ $o->id }}">{{ $o->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex align-items-end">
                                <button class="btn btn-ct-success w-100">Fichar</button>
                            </div>
                        </div>
                    </form>
                @else
                    <p class="ct-muted">Inicia sesión para fichar de forma rápida y segura.</p>
                    <a href="{{ route('login') }}" class="btn btn-ct-primary">Ir a inicio de sesión</a>
                @endauth
            </div>

            <div class="ct-card ct-section ct-actions-card">
                <div class="ct-section-header">
                    <h2 class="ct-section-title">Acciones rápidas</h2>
                    <span class="ct-pill"><i class="fas fa-layer-group"></i> Atajos</span>
                </div>
                <div class="ct-card-actions">
                    <a href="{{ route('trabajadores.create') }}" class="btn btn-ct-primary">Nuevo empleado</a>
                    <a href="{{ route('obras.create') }}" class="btn btn-ct-secondary">Nueva obra</a>
                    <a href="{{ route('asignaciones.create') }}" class="btn btn-ct-warning">Nueva asignación</a>
                    <a href="{{ route('fichajes.create') }}" class="btn btn-ct-success">Fichaje manual</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
