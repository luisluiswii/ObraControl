@extends('adminlte::page')

@section('title', 'Nuevo Empleado')

@section('content_header')
    <h1>Crear Empleado</h1>
@endsection

@section('content')
    <div class="ct-card">
    <form action="{{ route('trabajadores.store') }}" method="POST">
        @csrf

        @include('trabajadores.form')

        <button class="btn btn-ct-success">Guardar</button>
    </form>
    </div>
@endsection
