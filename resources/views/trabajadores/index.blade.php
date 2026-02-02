@extends('adminlte::page')

@section('title', 'Trabajadores')

@section('content_header')
    <h1>Listado de Trabajadores</h1>
@endsection

@section('content')
    <a href="{{ route('trabajadores.create') }}" class="btn btn-ct-primary mb-3">Nuevo Empleado</a>

    <table id="tabla-trabajadores" class="table table-bordered table-striped ct-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Puesto</th>
                <th>Salario por hora</th>
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
                    <td>{{ $trabajador->salario_hora }}</td>

                    <td>
                                <a href="{{ route('trabajadores.edit', $trabajador) }}" 
                                    class="btn btn-ct-warning btn-sm">
                            Editar
                        </a>

                        <form action="{{ route('trabajadores.destroy', $trabajador) }}" 
                              method="POST" 
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ct-danger btn-sm"
                                    onclick="return confirm('¿Eliminar trabajador?')">
                                Eliminar
                            </button>
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
        $('#tabla-trabajadores').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
            }
        });
    });
</script>
@endsection
