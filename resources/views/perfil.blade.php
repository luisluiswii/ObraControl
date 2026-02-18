@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1>Perfil</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="ct-grid ct-grid-2">
        <div class="ct-card p-4">
            <h2 class="ct-section-title mb-3">Tu cuenta</h2>

            <div class="ct-muted mb-3">Gestiona tu foto de perfil y tus datos básicos.</div>

            <div class="d-flex align-items-center gap-3 mb-3">
                @php($profilePhotoUrl = $user->profilePhotoUrl())

                @if($profilePhotoUrl)
                    <img src="{{ $profilePhotoUrl }}" alt="Foto de perfil" width="72" height="72" class="ct-profile-photo">
                @else
                    <div class="ct-profile-photo ct-profile-photo--placeholder" aria-hidden="true">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
                <div>
                    <div class="fw-bold">Foto de perfil</div>
                    <div class="ct-muted">Actualiza tu imagen para identificarte fácilmente.</div>
                </div>
            </div>

            <form action="{{ route('perfil.foto') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="form-group mb-2">
                    <label class="mb-1">Selecciona una imagen</label>
                    <input type="file" name="foto_perfil" class="form-control-file" accept="image/*" required>
                    @error('foto_perfil')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button class="btn btn-ct-primary btn-lg"><i class="fas fa-camera ct-btn-icon" aria-hidden="true"></i>Guardar foto</button>
            </form>

            <hr style="border-top: 1px solid var(--ct-light-grey);">

            <div class="mb-2"><strong>Nombre:</strong> {{ $user->name }}</div>
            <div class="mb-2"><strong>Email:</strong> {{ $user->email }}</div>
            <div class="mb-0"><strong>Rol:</strong> {{ $user->role }}</div>
        </div>

        <div class="ct-card p-4">
            <h2 class="ct-section-title mb-3">Adjuntar documentos</h2>
            <div class="ct-muted mb-3">Sube PDFs o imágenes asociados a tu cuenta.</div>

            <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ route('perfil') }}">

                <div class="form-group">
                    <label>Título</label>
                    <input type="text" name="nombre" class="form-control ct-input" value="{{ old('nombre') }}" placeholder="Ej: DNI, Contrato, Certificado...">
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control ct-input" rows="2" placeholder="Una frase breve del documento...">{{ old('descripcion') }}</textarea>
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

                <button class="btn btn-ct-success btn-lg"><i class="fas fa-upload ct-btn-icon" aria-hidden="true"></i>Subir</button>
                <a href="{{ route('documentos.index') }}" class="btn btn-ct-secondary btn-lg"><i class="fas fa-folder-open ct-btn-icon" aria-hidden="true"></i>Ver mis documentos</a>
            </form>
        </div>
    </div>

    <div class="ct-section-header mt-4 mb-3">
        <h2 class="ct-section-title">Tus documentos</h2>
    </div>

    <div class="ct-grid ct-grid-2">
        @forelse ($documentos as $documento)
            <div class="ct-card ct-card-ct d-flex flex-column justify-content-between p-4">
                <div class="mb-2">
                    <div class="fw-bold fs-5">{{ $documento->nombre }}</div>
                    <div class="ct-muted fs-6 mb-1">Subido: {{ optional($documento->created_at)->format('d/m/Y H:i') }}</div>
                    @if($documento->descripcion)
                        <div class="mb-2">{{ $documento->descripcion }}</div>
                    @endif
                </div>

                <div class="d-flex gap-2 align-items-center mt-auto">
                    @if($documento->archivo_pdf)
                        <a href="{{ asset('storage/' . $documento->archivo_pdf) }}"
                           target="_blank"
                           class="btn btn-ct-secondary btn-lg ct-btn-icon-only"
                           title="Ver archivo"
                           aria-label="Ver archivo">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </a>
                    @else
                        <span class="ct-pill">Sin archivo</span>
                    @endif

                    <form action="{{ route('documentos.destroy', $documento) }}" method="POST" style="display:inline" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-ct-danger btn-lg ct-btn-icon-only"
                                type="submit"
                                title="Eliminar"
                                aria-label="Eliminar"
                                onclick="return confirm('¿Eliminar documento?')">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="ct-card p-4">
                <div class="ct-muted">Todavía no has subido documentos.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $documentos->links() }}
    </div>
@endsection
