@extends('layouts.app')

@section('content')
    <div class="alert alert-danger">
        No tienes permiso para acceder a esta página.
    </div>
    <a href="{{ url('/') }}">Volver a la página principal</a>
@endsection
