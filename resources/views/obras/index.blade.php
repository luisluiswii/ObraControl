@extends('adminlte::page')

@section('title', 'Listado de Obras')

@section('content_header')
    <h1>Listado de Obras</h1>
@endsection

@section('content')

    <a href="{{ route('obras.create') }}" class="btn btn-ct-primary mb-3">Nueva obra</a>
    <a href="{{ route('obras.papelera') }}" class="btn btn-ct-warning mb-3">Papelera</a>

    <table id="tabla-obras" class="table table-bordered table-striped ct-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obras as $obra)
                <tr>
                    <td>{{ $obra->id }}</td>
                    <td>{{ $obra->nombre }}</td>
                    <td>{{ $obra->direccion }}</td>
                    <td>{{ $obra->estado }}</td>
                    <td>

                        {{-- Ver --}}
                        <a href="{{ route('obras.show', $obra->id) }}"
                                    class="btn btn-ct-secondary btn-sm">Ver</a>

                        {{-- Editar --}}
                        <a href="{{ route('obras.edit', $obra->id) }}"
                                    class="btn btn-ct-warning btn-sm">Editar</a>

                        {{-- Eliminar --}}
                        <form action="{{ route('obras.destroy', $obra->id) }}"
                              method="POST"
                              class="form-eliminar"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ct-danger btn-sm">Eliminar</button>
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
