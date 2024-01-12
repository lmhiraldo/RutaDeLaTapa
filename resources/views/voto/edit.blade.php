@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        {{-- <div class="card-header">
            <h3><strong>Editar Voto</strong></h3>
        </div> --}}

        <style>
            .btn-full-width {
                width: 100%;
            }
        </style>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ session('error') }}
                <button type of="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $tapa->img) }}" alt="{{ $tapa->name }}" class="img-fluid img-thumbnail"
                    style="max-width: 400px; border: 1px solid #ddd;">
            </div>
            <div class="col-md-8">
                <h3>{{ $tapa->name }}</h3>
                <p><strong>Bar: {{ $bar->name }}</strong></p>

                <form action="{{ route('voto.update', $voto->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="rating">Puntuación:</label>
                        <input type="number" name="rating" id="rating" class="form-control"
                            value="{{ $voto->rating }}">
                    </div>

                    <div class="form-group">
                        <label for="comment">Comentario:</label>
                        <textarea name="comment" id="comment" class="form-control">{{ $voto->comment }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success mb-3 mt-3 btn-full-width"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Guardar cambios</button>

                </form>

                <a href="{{ route('voto.user-voto') }}" class="btn"
                    style="background-color: var(--bs-blue);color: white;display: block; margin-top: 10px;"><i
                        class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>



            </div>
        </div>
    </div>
@endsection
