@extends('adminlte::page')

@section('title', 'Listado de Obras')

@section('content_header')
    <h1>Listado de Obras</h1>
@endsection

@section('content')

    <div class="ct-section-header mb-3">
        <h2 class="ct-section-title">Listado de Obras</h2>
        <div class="d-flex ct-obras-header-actions">
            <a href="{{ route('obras.create') }}" class="btn btn-ct-success btn-lg shadow-sm"><i class="fas fa-plus ct-btn-icon" aria-hidden="true"></i>Nueva obra</a>
            <a href="{{ route('obras.papelera') }}" class="btn btn-ct-secondary btn-lg shadow-sm"><i class="fas fa-trash ct-btn-icon" aria-hidden="true"></i>Papelera</a>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $obras->links('vendor.pagination.default') }}
    </div>
    <div class="ct-grid ct-grid-2">
        @foreach ($obras as $obra)
            <div class="ct-card d-flex flex-column justify-content-between p-4">
                <div class="mb-2">
                    <div class="fw-bold fs-5">{{ $obra->nombre }}</div>
                    <div class="ct-muted fs-6 mb-1">ID: {{ $obra->id }}</div>
                    <div class="mb-2">{{ $obra->direccion }}</div>
                </div>
                <div class="mb-2">
                    <span class="ct-pill ct-pill-ct me-2"><i class="fas fa-info-circle"></i> {{ $obra->estado }}</span>
                </div>
                <div class="d-flex gap-2 align-items-center mt-auto">
                    <a href="{{ route('obras.show', $obra->id) }}"
                       class="btn btn-ct-secondary btn-lg ct-btn-icon-only"
                       title="Ver"
                       aria-label="Ver">
                        <i class="fas fa-search" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('obras.edit', $obra->id) }}"
                       class="btn btn-ct-primary btn-lg ct-btn-icon-only"
                       title="Editar"
                       aria-label="Editar">
                        <i class="fas fa-pen" aria-hidden="true"></i>
                    </a>
                    <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" class="m-0 p-0" style="display: flex;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-ct-danger btn-lg ct-btn-icon-only"
                                type="submit"
                                title="Eliminar"
                                aria-label="Eliminar"
                                onclick="return confirm('¿Eliminar obra?')">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $obras->links('vendor.pagination.default') }}
    </div>

@endsection

@section('js')
<script>
$(document).ready(function() {

    $('#tabla-obras').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" }
    });

    $('.form-eliminar').on('submit', function(e) {
        e.preventDefault();
        let form = this;

        Swal.fire({
            title: '¿Eliminar obra?',
            text: "La obra pasará a la papelera",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });

});
</script>
@endsection
