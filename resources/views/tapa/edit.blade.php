@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">

        <form action="{{ url('/tapa/' . $tapa->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}

            @include('tapa.form', ['modo' => 'Editar']) <br>

        </form>
    </div>
@endsection
