@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Listado de Productos</h1>
@endsection

@section('content')
    <a href="{{ route('productos.create') }}" class="btn btn-ct-primary mb-3">Nuevo Producto</a>
    <table class="table table-bordered table-striped ct-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Archivo PDF</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>
                        @if($producto->archivo_pdf)
                            <a href="{{ asset('storage/' . $producto->archivo_pdf) }}" target="_blank">Ver PDF</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <!-- Acciones futuras -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
