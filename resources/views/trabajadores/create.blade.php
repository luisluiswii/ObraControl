@extends('adminlte::page')

@section('title', 'Nuevo Empleado')

@section('content_header')
    <h1>Crear Empleado</h1>
@endsection

@section('content')
    <form action="{{ route('trabajadores.store') }}" method="POST">
        @csrf

        @include('trabajadores.form')

        <button class="btn btn-primary">Guardar</button>
    </form>
@endsection
