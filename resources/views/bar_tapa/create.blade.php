@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <h2 class="m-0">Asigna Tapa</h2>
            </div>
        </div>
    </div>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('bar_tapa.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="tapas"><strong>Tapas</strong></label>
                                <select class="form-control select2" name="tapas[]" id="tapas" required>
                                    <option value="" disabled selected>Selecciona una tapa</option>
                                    @foreach ($tapas as $id => $tapa)
                                        <option value="{{ $id }}">{{ $tapa }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tapas'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('tapas') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="bars"><strong>Bar</strong></label>
                                <select class="form-control select2" name="bars[]" id="bars" required>
                                    <option value="" disabled selected>Selecciona un bar</option>
                                    @foreach ($bars as $id => $bar)
                                        <option value="{{ $id }}">{{ $bar }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bars'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('bars') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="row d-print-none mt-2">
                                <div class="col-12 text-right">
                                    <a class="btn" style="background-color: var(--bs-blue);color:white;"
                                        href="{{ route('bar_tapa.index') }}">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        Regresar
                                    </a>
                                    <button class="btn btn-success" type="submit">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2()
        })
    </script>
@endsection
