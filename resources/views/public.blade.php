@extends('adminlte::auth.auth-page', ['authType' => 'landing'])

@section('auth_header')
    Bienvenido a ClearTime
@endsection

@section('auth_body')
    <div class="mb-3 ct-muted">
        Plataforma profesional para gestionar horarios, fichajes y jornadas de tu equipo.
    </div>

    <div class="ct-card ct-card-ct p-3 mb-3">
        <div class="fw-bold mb-1">¿Qué puedes hacer?</div>
        <ul class="mb-0 pl-3 ct-muted">
            <li>Control de fichajes y jornadas en tiempo real.</li>
            <li>Gestión de empleados, obras y asignaciones.</li>
            <li>Documentos asociados a cada usuario.</li>
        </ul>
    </div>

    <a href="{{ route('login') }}" class="btn btn-ct-primary btn-lg w-100">
        <span class="fas fa-sign-in-alt"></span>
        Acceder
    </a>

    <div class="mt-3 ct-muted" style="font-size: 0.92rem;">
        Si no tienes acceso, contacta con administración.
    </div>
@endsection
