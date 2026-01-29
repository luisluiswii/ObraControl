@extends('adminlte::page')

@section('title', 'Bienvenido')

@section('content_header')
    <h1 class="text-center">Bienvenido al CRM de Obras</h1>
@endsection

@section('content')
<div class="row mt-4">

    <div class="col-md-12 text-center mb-4">
        <p class="lead">Gestiona obras, trabajadores, asignaciones y jornadas desde un único panel.</p>
    </div>

    <div class="col-md-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h4>Obras</h4>
                <p>Gestiona todas las obras activas y archivadas.</p>
                <a href="{{ route('obras.index') }}" class="btn btn-light">Entrar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h4>Trabajadores</h4>
                <p>Control total de empleados, asignaciones y fichajes.</p>
                <a href="{{ route('trabajadores.index') }}" class="btn btn-light">Entrar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h4>Jornadas</h4>
                <p>Consulta y gestiona las jornadas laborales.</p>
                <a href="#" class="btn btn-light">Entrar</a>
            </div>
        </div>
    </div>

</div>
@endsection
