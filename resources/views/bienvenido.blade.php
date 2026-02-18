@extends('adminlte::page')

@section('title', 'ClearTime')

@section('content_header')
    <div class="ct-hero">
        <div>
            <h1>Bienvenido a ClearTime</h1>
            <p>Control horario y gestión sencilla para todos los usuarios.</p>
        </div>
        <div class="ct-hero-badge">Acceso rápido y seguro</div>
    </div>
@stop

@section('content')
<div class="ct-app">
    <div class="ct-dashboard">
        <div class="ct-grid">
            <div class="ct-card ct-section">
                <div class="ct-section-header">
                    <h2 class="ct-section-title">¡Bienvenido!</h2>
                </div>
                <p>Este es el panel principal de ClearTime. Desde aquí puedes acceder a tus funciones básicas según tu perfil.</p>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('gestion') }}" class="btn btn-ct-primary btn-lg mt-3">Ir a Gestión</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
