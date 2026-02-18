@extends('adminlte::page')

@section('title', 'Trabajadores')

@section('content_header')
    <h1>Listado de Trabajadores</h1>
@endsection


@section('content')
    <div class="ct-section-header mb-3">
        <h2 class="ct-section-title">Listado de Trabajadores</h2>
        <div class="d-flex" style="gap: 10px;">
            @auth
                @can('manageUsers')
                    <a href="{{ route('usuarios.index') }}" class="btn btn-ct-secondary btn-lg shadow-sm"><i class="fas fa-user-shield ct-btn-icon" aria-hidden="true"></i>Usuarios CRM</a>
                @endcan
                @can('create', App\Models\User::class)
                    <a href="{{ route('trabajadores.create') }}" class="btn btn-ct-success btn-lg shadow-sm"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Nuevo Empleado</a>
                @endcan
            @endauth
        </div>
    </div>
    <div class="ct-grid ct-grid-2">
        @foreach ($trabajadores as $trabajador)
            <div class="ct-card ct-card-ct d-flex flex-column justify-content-between p-4">
                <div class="d-flex align-items-center mb-3 ct-worker-header">
                    <div class="ct-avatar-ct ct-worker-avatar">
                        @php
                            $fotoPath = $trabajador->foto ? storage_path('app/public/' . $trabajador->foto) : null;
                        @endphp
                        @if($trabajador->foto && $fotoPath && file_exists($fotoPath))
                            <img src="{{ asset('storage/' . $trabajador->foto) }}" alt="Foto" class="ct-avatar-img-ct">
                        @else
                            <i class="fas fa-user ct-avatar-icon-ct"></i>
                        @endif
                    </div>
                    <div>
                        <div class="fw-bold fs-5">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</div>
                        <div class="ct-muted fs-6">{{ $trabajador->email }}</div>
                    </div>
                </div>
                <div class="ct-worker-meta mb-3">
                    <span class="ct-pill ct-pill-ct"><i class="fas fa-briefcase"></i> {{ $trabajador->puesto }}</span>
                    <span class="ct-pill ct-pill-ct"><i class="fas fa-euro-sign"></i> {{ $trabajador->salario_hora }} €/h</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('trabajadores.edit', $trabajador) }}" class="btn btn-ct-primary btn-lg flex-fill"><i class="fas fa-pen ct-btn-icon" aria-hidden="true"></i>Editar</a>
                    @auth
                        @can('delete', $trabajador)
                            <form action="{{ route('trabajadores.destroy', $trabajador) }}" method="POST" class="flex-fill" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-ct-danger btn-lg w-100" onclick="return confirm('¿Eliminar trabajador?')"><i class="fas fa-trash ct-btn-icon" aria-hidden="true"></i>Eliminar</button>
                            </form>
                        @endcan
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $trabajadores->links('vendor.pagination.default') }}
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tabla-trabajadores').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });
</script>
@endsection
