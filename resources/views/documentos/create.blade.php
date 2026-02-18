@extends('adminlte::page')

@section('title', 'Subir Documento')

@section('content_header')
    <h1>Nuevo Documento</h1>
@endsection

@section('content')
    <div class="ct-card p-4">
        <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="nombre" class="form-control ct-input" value="{{ old('nombre') }}" placeholder="Ej: Nómina febrero, Contrato, Certificado...">
                @error('nombre')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control ct-input" rows="3" placeholder="Una frase breve sobre el documento...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Archivo (PDF o imagen)</label>
                <input type="file" name="archivo" class="form-control-file" accept="application/pdf,image/*">
                @error('archivo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-ct-success btn-lg"><i class="fas fa-save ct-btn-icon" aria-hidden="true"></i>Guardar</button>
            <a href="{{ route('documentos.index') }}" class="btn btn-ct-secondary btn-lg"><i class="fas fa-arrow-left ct-btn-icon" aria-hidden="true"></i>Volver</a>
        </form>
    </div>
@endsection
