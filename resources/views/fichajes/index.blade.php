@extends('adminlte::page')

@section('title', 'Fichajes')

@section('content_header')
    <h1>Fichajes</h1>
@endsection

@section('content')

{{-- FORMULARIO PARA INICIAR JORNADA --}}
<div class="ct-card mb-4">

        <form action="{{ route('jornadas.iniciar') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-md-4">
                    <label>Trabajador</label>
                    <select name="trabajador_id" class="form-control ct-select" required>
                        @foreach($trabajadores as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->nombre }} {{ $t->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Obra</label>
                    <select name="obra_id" class="form-control ct-select" required>
                        @foreach($obras as $o)
                            <option value="{{ $o->id }}">
                                {{ $o->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-ct-success w-100">
                        <i class="fas fa-play ct-btn-icon" aria-hidden="true"></i>Iniciar jornada
                    </button>
                </div>

            </div>
        </form>

</div>


<div class="ct-section-header mb-3">
    <h2 class="ct-section-title">Listado de Fichajes</h2>
    <a href="{{ route('fichajes.create') }}" class="btn btn-ct-success btn-lg shadow-sm"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Nuevo Fichaje</a>
</div>
<div class="ct-grid ct-grid-2">
    @foreach ($fichajes as $f)
        <div class="ct-card d-flex flex-column justify-content-between p-4">
            <div class="mb-2">
                <div class="fw-bold fs-5">
                    {{ optional($f->trabajador)?->nombre ?? '—' }} {{ optional($f->trabajador)?->apellido ?? '' }}
                </div>
                <div class="ct-muted fs-6 mb-1">Obra: {{ optional($f->obra)?->nombre ?? '—' }}</div>
                <div class="mb-2">Fecha: {{ $f->fecha }}</div>
            </div>
            <div class="mb-2">
                <span class="ct-pill ct-pill-ct me-2"><i class="fas fa-sign-in-alt"></i> {{ $f->hora_entrada }}</span>
                <span class="ct-pill ct-pill-ct me-2"><i class="fas fa-sign-out-alt"></i> {{ $f->hora_salida ?? '—' }}</span>
                <span class="ct-pill ct-pill-ct"><i class="fas fa-clock"></i> {{ $f->horas_trabajadas ?? '—' }}</span>
            </div>
            <div class="d-flex gap-2 align-items-center mt-auto">
                @if(!$f->hora_salida)
                    <form action="{{ route('jornadas.finalizar', $f->id) }}" method="POST" class="flex-fill" style="display:inline">
                        @csrf
                        <button class="btn btn-ct-warning btn-lg w-100"><i class="fas fa-stop ct-btn-icon" aria-hidden="true"></i>Finalizar</button>
                    </form>
                @endif
                <form action="{{ route('fichajes.destroy', $f->id) }}" method="POST" class="flex-fill" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-ct-danger btn-lg w-100"><i class="fas fa-trash ct-btn-icon" aria-hidden="true"></i>Eliminar</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-4">
    {{ $fichajes->links('vendor.pagination.default') }}
</div>

@endsection
