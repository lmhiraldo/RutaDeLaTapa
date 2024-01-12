@extends('layouts.app')

@section('content')
    <div class="container" id="content" style="margin-top: 20px;">

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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
                <p><strong>Bar:{{ $bar->name }}</strong></p>

                <form action="{{ route('voto.store', ['bar_tapa_id' => $barTapa->id]) }}" method="POST">
                    @csrf
                    <select class="form-control select2" name="rating" id="rating" required>
                        <option value="" disabled selected>Valoración</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for= "comment" style="margin-bottom: 10px;margin-top: 10px;"><strong>Comentario
                                (opcional):</strong></label>
                        <textarea name="comment" id="comment" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success mb-3 mt-3" style="width: 100%;"><i
                            class="fa fa-fw fa-lg fa-check-circle"></i>Votar</button>


                </form>


                <a href="{{ route('voto.index') }}" class="btn"
                    style="background-color: var(--bs-blue); color: white;white;display: block; margin-top: 10px;"><i
                        class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>


            </div>
        </div>


    </div>
@endsection
