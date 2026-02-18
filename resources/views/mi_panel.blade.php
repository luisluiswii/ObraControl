@extends('adminlte::page')

@section('title', 'Mi Panel')

@section('content_header')
    <h1>Mi Panel</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!$trabajador)
        <div class="ct-card p-4">
            <h2 class="ct-section-title mb-2">Tu cuenta aún no está asociada a un trabajador</h2>
            <div class="ct-muted">Para usar el panel de jornada, tu email ({{ $user->email }}) debe coincidir con el email de un trabajador.</div>
        </div>
        @php($stopRendering = true)
    @endif

    @if(empty($stopRendering))
        <div class="ct-grid">
            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-primary"><i class="fas fa-user"></i></div>
                <div>
                    <div class="ct-kpi-label">Trabajador</div>
                    <div class="ct-kpi-value" style="font-size: 20px;">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</div>
                    <div class="ct-muted">{{ $trabajador->puesto ?? '—' }}</div>
                </div>
            </div>

            <div class="ct-kpi-card">
                <div class="ct-kpi-icon ct-warning"><i class="fas fa-clock"></i></div>
                <div>
                    <div class="ct-kpi-label">Jornada</div>
                    <div class="ct-kpi-value" style="font-size: 20px;">
                        {{ $jornadaAbierta ? 'Abierta' : 'Cerrada' }}
                    </div>
                    <div class="ct-muted">
                        @if($jornadaAbierta)
                            Obra: {{ optional($jornadaAbierta->obra)->nombre ?? '—' }}
                        @else
                            Inicia tu jornada cuando comiences.
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="ct-grid ct-grid-2 mt-4">
            <div class="ct-card p-4">
                <h2 class="ct-section-title mb-3">Mi jornada de hoy</h2>

                @if($jornadaAbierta)
                    <div class="ct-muted mb-3">Has iniciado a las {{ $jornadaAbierta->hora_entrada }}. Finaliza cuando termines.</div>
                    <form action="{{ route('mi-jornada.finalizar') }}" method="POST">
                        @csrf
                        <button class="btn btn-ct-warning btn-lg"><i class="fas fa-stop ct-btn-icon" aria-hidden="true"></i>Finalizar jornada</button>
                    </form>
                @else
                    <div class="ct-muted mb-3">Selecciona una obra asignada y pulsa iniciar.</div>
                    <form action="{{ route('mi-jornada.iniciar') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Obra</label>
                            <select name="obra_id" class="form-control ct-select" required>
                                <option value="">Selecciona una obra…</option>
                                @foreach($obrasAsignadas as $obra)
                                    <option value="{{ $obra->id }}">{{ $obra->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-ct-success btn-lg"><i class="fas fa-play ct-btn-icon" aria-hidden="true"></i>Iniciar jornada</button>
                    </form>
                @endif
            </div>

            <div class="ct-card p-4">
                <h2 class="ct-section-title mb-3">Accesos rápidos</h2>
                <div class="ct-muted mb-3">Tus herramientas personales de uso diario.</div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('perfil') }}" class="btn btn-ct-primary btn-lg"><i class="fas fa-user-circle ct-btn-icon" aria-hidden="true"></i>Perfil</a>
                    <a href="{{ route('documentos.index') }}" class="btn btn-ct-secondary btn-lg"><i class="fas fa-folder-open ct-btn-icon" aria-hidden="true"></i>Documentos</a>
                </div>
            </div>
        </div>

        <div class="ct-section-header mt-4 mb-3">
            <h2 class="ct-section-title">Mis fichajes recientes</h2>
        </div>

        <div class="ct-grid ct-grid-2">
            @forelse($misFichajes as $f)
                <div class="ct-card ct-card-ct p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="fw-bold">{{ optional($f->obra)->nombre ?? '—' }}</div>
                        <div class="ct-muted">{{ $f->fecha }} · {{ $f->hora_entrada }} → {{ $f->hora_salida ?? '—' }}</div>
                    </div>
                    <div class="mt-2">
                        @if($f->horas_trabajadas)
                            <span class="ct-pill ct-pill-ct">{{ $f->horas_trabajadas }} h</span>
                        @else
                            <span class="ct-pill">En curso</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="ct-card p-4">
                    <div class="ct-muted">Aún no tienes fichajes registrados.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $misFichajes->links() }}
        </div>
    @endif
@endsection
