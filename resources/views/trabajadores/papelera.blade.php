@extends('adminlte::page')

@section('title', 'Papelera de Trabajadores')

@section('content_header')
    <h1>Papelera de Trabajadores</h1>
@endsection

@section('content')

    <a href="{{ route('trabajadores.index') }}" class="btn btn-ct-secondary mb-3">Volver</a>

    <table id="tabla-papelera-trabajadores" class="table table-bordered table-striped ct-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Email</th>
                <th>Puesto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trabajadores as $trabajador)
                <tr>
                    <td>{{ $trabajador->id }}</td>
                    <td>{{ $trabajador->nombre }} {{ $trabajador->apellido }}</td>
                    <td>{{ $trabajador->email }}</td>
                    <td>{{ $trabajador->puesto }}</td>
                    <td>

                        {{-- Restaurar --}}
                        <form action="{{ route('trabajadores.restaurar', $trabajador->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            <button class="btn btn-ct-success btn-sm">Restaurar</button>
                        </form>

                        {{-- Eliminar definitivo --}}
                        <form action="{{ route('trabajadores.eliminarDefinitivo', $trabajador->id) }}"
                              method="POST"
                              class="form-eliminar"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ct-danger btn-sm">Eliminar Definitivo</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('js')
<script>
$(document).ready(function() {

    $('#tabla-papelera-trabajadores').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" }
    });

    $('.form-eliminar').on('submit', function(e) {
        e.preventDefault();
        let form = this;

        Swal.fire({
            title: '¿Eliminar definitivamente?',
            text: "No podrás recuperarlo después",
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
