@extends('adminlte::page')

@section('title', 'Crear Producto')

@section('content_header')
    <h1>Crear Producto</h1>
@endsection

@section('content')
    <div class="ct-card">
    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control ct-input" value="{{ old('nombre') }}">
        </div>
        <div class="form-group">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control ct-input">{{ old('descripcion') }}</textarea>
        </div>
        <div class="form-group">
            <label>Archivo PDF</label>
            <input type="file" name="archivo_pdf" class="form-control-file" accept="application/pdf">
        </div>
        <button class="btn btn-ct-success">Guardar</button>
    </form>
    </div>
@endsection
