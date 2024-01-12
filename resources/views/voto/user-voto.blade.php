@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">
        <h3>Tus votos</h3>
        @if ($votosWithNames->isEmpty())
            <p>No has realizado ningún voto aún.</p>
        @else
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

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-secondary align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Tapa</th>
                            <th class="text-center">Bar</th>
                            <th class="text-center">Comentario</th>
                            <th class="text-center">Puntuación</th>

                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($votosWithNames as $votoData)
                            <tr class="table-light">
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $votoData['img']) }}" alt="{{ $votoData['tapa'] }}"
                                        class="img-fluid img-thumbnail" style="max-width: 100px; border: 1px solid #ddd;">
                                </td>
                                <td class="text-center">{{ $votoData['tapa'] }}</td>
                                <td class="text-center">{{ $votoData['bar'] }}</td>
                                <td class="text-center">{{ $votoData['voto']->comment ?: 'N/A' }}</td>
                                {{-- <td class="text-center">{{ $votoData['voto']->rating }} </td> --}}
                                <td class="text-center">
                                    {{ $votoData['stars'] }}</td>

                                <td class="text-center d-flex">
                                    <a href="{{ route('voto.edit', $votoData['voto']->id) }}"
                                        class="btn btn-success mr-2"><i class="fas fa-edit"></i></a>
                                    &nbsp;|&nbsp;
                                    <form action="{{ route('voto.destroy', $votoData['voto']->id) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este voto?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content">
                    <a href="{{ route('voto.index') }}" class="btn mt-3"
                        style="background-color: var(--bs-blue);color: white;"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>&nbsp;&nbsp;
                </div>
            </div>
        @endif
    </div>
@endsection
