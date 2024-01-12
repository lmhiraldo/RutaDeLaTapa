@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 50px;">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Atención!</h4>
            <p>Para continuar navegando en esta página es necesario aceptar el uso de cookies.</p>
            <hr>
            <p class="mb-0">Haz clic en el botón de abajo para aceptar las cookies y acceder al dashboard.</p>
            <a href="{{ route('cookies.dashboard') }}" class="btn"
                style="background-color: var(--bs-blue);color: white; margin-top: 10px;">Aceptar cookies</a>
        </div>
    </div>
@endsection
