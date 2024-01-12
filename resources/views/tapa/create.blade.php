@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">

        <form action="{{ url('/tapa') }}" method="post" enctype="multipart/form-data"><br>
            @csrf
            @include('tapa.form', ['modo' => 'Añadir'])

        </form>
    </div>
@endsection
