@extends('adminlte::page')

@section('title', 'Gestión')

@section('content_header')
    <h1>Panel de Gestión</h1>
@endsection

@section('content')
    <div class="ct-app ct-page-gestion">
        <div class="ct-dashboard">
            <div class="ct-grid">
                <div class="ct-kpi-card">
                    <div class="ct-kpi-icon ct-primary"><i class="fas fa-building"></i></div>
                    <div>
                        <div class="ct-kpi-label">Obras activas</div>
                        <div class="ct-kpi-value">{{ $obrasCount }}</div>
                        <a class="ct-kpi-link" href="{{ route('obras.index') }}">Ver obras</a>
                    </div>
                </div>
                <div class="ct-kpi-card">
                    <div class="ct-kpi-icon ct-success"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="ct-kpi-label">Empleados</div>
                        <div class="ct-kpi-value">{{ $trabajadoresCount }}</div>
                        <a class="ct-kpi-link" href="{{ route('trabajadores.index') }}">Ver empleados</a>
                    </div>
                </div>
                <div class="ct-kpi-card">
                    <div class="ct-kpi-icon ct-warning"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="ct-kpi-label">Fichajes hoy</div>
                        <div class="ct-kpi-value">{{ $fichajesHoy }}</div>
                        <a class="ct-kpi-link" href="{{ route('fichajes.index') }}">Historial</a>
                    </div>
                </div>
                <div class="ct-kpi-card">
                    <div class="ct-kpi-icon ct-accent"><i class="fas fa-play-circle"></i></div>
                    <div>
                        <div class="ct-kpi-label">Jornadas abiertas</div>
                        <div class="ct-kpi-value">{{ $jornadasAbiertas }}</div>
                        <a class="ct-kpi-link" href="{{ route('jornadas.index') }}">Ver jornadas</a>
                    </div>
                </div>
            </div>

            <div class="ct-section-header mt-4 mb-3">
                <h2 class="ct-section-title">Accesos rápidos de gestión</h2>
            </div>

            <div class="ct-quick-actions">
                <a href="{{ route('trabajadores.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-success"><i class="fas fa-users"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Trabajadores</div>
                        <div class="ct-qa-desc">Alta, edición y control de empleados en el sistema.</div>
                    </div>
                </a>

                <a href="{{ route('obras.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-primary"><i class="fas fa-building"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Obras</div>
                        <div class="ct-qa-desc">Gestiona obras, estados y documentación asociada.</div>
                    </div>
                </a>

                <a href="{{ route('asignaciones.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-accent"><i class="fas fa-random"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Asignaciones</div>
                        <div class="ct-qa-desc">Asigna trabajadores a obras con fechas y seguimiento.</div>
                    </div>
                </a>

                <a href="{{ route('fichajes.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-warning"><i class="fas fa-clock"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Fichajes</div>
                        <div class="ct-qa-desc">Consulta el historial de entradas, salidas y horas.</div>
                    </div>
                </a>

                <a href="{{ route('jornadas.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-secondary"><i class="fas fa-play-circle"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Jornadas</div>
                        <div class="ct-qa-desc">Inicia y finaliza jornadas para controlar el día a día.</div>
                    </div>
                </a>

                <a href="{{ route('documentos.index') }}" class="ct-quick-action">
                    <div class="ct-qa-icon ct-primary"><i class="fas fa-folder-open"></i></div>
                    <div class="ct-qa-text">
                        <div class="ct-qa-title">Documentos</div>
                        <div class="ct-qa-desc">Sube y gestiona PDFs o imágenes asociados a tu cuenta.</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
