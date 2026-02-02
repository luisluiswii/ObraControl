@extends('adminlte::auth.auth-page', ['authType' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php
    $loginUrl = View::getSection('login_url') ?? config('adminlte.login_url', 'login');
    $registerUrl = View::getSection('register_url') ?? config('adminlte.register_url', 'register');
    $passResetUrl = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset');

    if (config('adminlte.use_route_url', false)) {
        $loginUrl = $loginUrl ? route($loginUrl) : '';
        $registerUrl = $registerUrl ? route($registerUrl) : '';
        $passResetUrl = $passResetUrl ? route($passResetUrl) : '';
    } else {
        $loginUrl = $loginUrl ? url($loginUrl) : '';
        $registerUrl = $registerUrl ? url($registerUrl) : '';
        $passResetUrl = $passResetUrl ? url($passResetUrl) : '';
    }
@endphp

@section('auth_header', 'Inicia sesión para continuar')

@section('auth_body')
    <form action="{{ $loginUrl }}" method="post">
        @csrf

        {{-- Campo email --}}
        <div class="input-group mb-3 ct-auth-input-group">
            <input type="email" name="email" class="form-control ct-input @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="Correo electrónico" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Campo contraseña --}}
        <div class="input-group mb-3 ct-auth-input-group">
            <input type="password" name="password" class="form-control ct-input @error('password') is-invalid @enderror"
            placeholder="Contraseña">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Acciones --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary" title="Mantener sesión iniciada">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label for="remember">
                        Recordarme
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type=submit class="btn btn-block btn-ct-primary {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                    <span class="fas fa-sign-in-alt"></span>
                    Entrar
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    {{-- Recuperar contraseña --}}
    @if($passResetUrl)
        <p class="my-0">
            <a href="{{ $passResetUrl }}">
                Olvidé mi contraseña
            </a>
        </p>
    @endif

    {{-- Registro --}}
    @if($registerUrl)
        <p class="my-0">
            <a href="{{ $registerUrl }}">
                Crear una cuenta
            </a>
        </p>
    @endif
@stop
