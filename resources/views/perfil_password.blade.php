@extends('adminlte::page')

@section('title', 'Cambiar contraseña')

@section('content_header')
    <h1>Cambiar contraseña</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="ct-card p-4" style="max-width: 720px;">
        <h2 class="ct-section-title mb-2">Actualiza tu contraseña</h2>
        @if($user->must_change_password)
            <div class="ct-muted mb-3">Por seguridad, debes cambiar la contraseña inicial antes de continuar.</div>
        @else
            <div class="ct-muted mb-3">Puedes actualizar tu contraseña cuando lo necesites.</div>
        @endif

        <form action="{{ route('perfil.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nueva contraseña</label>
                <input type="password" name="password" class="form-control ct-input" placeholder="Mínimo 8 caracteres" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Repite la nueva contraseña</label>
                <input type="password" name="password_confirmation" class="form-control ct-input" required>
            </div>

            <button class="btn btn-ct-success btn-lg">Guardar contraseña</button>
            <a href="{{ route('perfil') }}" class="btn btn-ct-secondary btn-lg">Volver</a>
        </form>
    </div>
@endsection
