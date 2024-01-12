@extends('layouts.app')

@section('template_title')
    {{ $tapa->name ?? __('Detalle') }}
@endsection


@section('content')
    <section class="content container-fluid h-100" style="margin-top: 20px;">


        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ __('Detalle') }} Tapa </strong>
                        </div>

                    </div>


                    <div class="card-body">

                        {{-- <div class="form-group">
                            <strong>Tapa_id:</strong>
                            {{ $tapa->id }}
                        </div> --}}

                        <div class="form-group mb-1">


                            <img class="img-fluid img-thumbnail" src="{{ asset('storage' . '/' . $tapa->img) }}"
                                width="200px" alt="">

                        </div>
                        <div class="form-group mb-1">
                            <strong>Nombre: </strong>
                            <strong>{{ $tapa->name }}</strong>
                        </div>
                        <div class="form-group mb-1">
                            <strong>Descripción: </strong>
                            {{ $tapa->description }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Precio: </strong>
                            {{ $tapa->price }} €
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-2 ml-2">
                    <a class="btn" style="background-color: var(--bs-blue); color: white;"
                        href="{{ route('tapa.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        {{ __('Regresar') }}</a>

                </div>
            </div>
        </div>
    </section>
@endsection
