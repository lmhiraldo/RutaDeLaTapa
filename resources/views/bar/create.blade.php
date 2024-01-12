@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">

        <form action="{{ url('/bars') }}" method="post" enctype="multipart/form-data"><br>
            @csrf
            @include('bar.form', ['modo' => 'Añadir'])<br>


        </form>
    </div>
@endsection
