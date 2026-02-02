@extends('adminlte::page')

@section('title', 'Editar Trabajador')

@section('content_header')
    <h1>Editar Trabajador</h1>
@endsection

@section('content')
    <div class="ct-card">
    <form action="{{ route('trabajadores.update', $trabajador) }}" method="POST">
        @csrf
        @method('PUT')

        @include('trabajadores.form')

        <button class="btn btn-ct-success">Actualizar</button>
    </form>
    </div>
@endsection
