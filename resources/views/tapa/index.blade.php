@extends('layouts.app')

@section('content')
<style>
    .btn-group button {
        margin-right: 10px;
    }
 </style>
    <div class="container" style="margin-top: 20px;">
        <!-- Alerta mensaje -->
        @if (Session::has('mensaje'))
            <div id="alerta" class="alert alert-success alert-dismissible" role="alert">
                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="cerrarAlerta()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <script>
                function cerrarAlerta() {
                    document.getElementById("alerta").style.display = "none";
                }
            </script>
        @endif

        <form action="{{ route('tapa.index') }}" method="GET" class="form-inline mt-3 mb-3">
            <div class="d-flex justify-content-between w-100">
                <div class="form-group flex-fill ml-2" style="margin-right: 10px;">
                    <input type="text" name="search" class="form-control" placeholder="Buscar tapas"
                        value="{{ $search }}" id="searchInput">
                </div>
                <button type="submit" class="btn" style="background-color: var(--bs-blue); color: white;"
                    id="searchButton">Buscar</button>
            </div>
        </form>

        @if (empty($search))
            <a href="{{ route('bar_tapa.dashboard') }}" class="btn mb-3 mt-3 shadow"
                style="background-color: #a5b6a5; color: white;"><i
                    class="fa fa-fw fa-lg fa-arrow-left"></i>Dashboard</a>&nbsp;&nbsp;
            <a href="{{ url('tapa/create') }}" class="btn"
                style="background-color: var(--bs-blue); color: white;">Registrar nueva tapa</a>&nbsp;&nbsp;
            <a href="{{ url('tapa/pdf') }}" class="btn btn-success float-right">PDF</a>&nbsp;&nbsp;
            <a href="{{ url('tapa/chartbar') }}" class="btn btn-warning float-right">Gráfica</a><br>
        @endif

        @if (!empty($search))
            <a href="{{ url('tapa') }}" class="btn"
                style="background-color: var(--bs-blue); color: white;">Regresar</a><br><br>
        @endif

        <!-- Formulario de búsqueda -->

        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-secondary align-middle">
                <thead class="table-light">
                    <caption>Lista de tapas</caption>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($tapas as $tapa)
                        <tr class="table-light">
                            <td>
                                <img class="img-fluid img-thumbnail" src="{{ asset('storage' . '/' . $tapa->img) }}"
                                    width="200px" alt="">
                            </td>
                            <td><strong>{{ $tapa->name }}</strong></td>
                            <td>{{ $tapa->description }}</td>
                            <td>{{ $tapa->price }} €</td>
                            <td>
                                <div class="btn-group">
                                <a href="{{ url('/tapa/' . $tapa->id . '/edit') }}" class="btn btn-success"><i
                                        class="fas fa-edit"></i></a> &nbsp;| &nbsp;
                                <form action="{{ route('tapa.destroy', $tapa->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" onclick="confirmDelete('{{ route('tapa.destroy', $tapa->id) }}')"><i class="fas fa-trash-alt"></i></button>
                                </form>

                                &nbsp;| &nbsp;<form action="{{ url('/tapa/' . $tapa->id) }}" class="d-inline" method="get">
                                    @csrf
                                    <button class="btn btn-warning" type="submit"><i class="fas fa-eye"
                                            style="color: white; text-shadow: 1px 1px 1px #000;"></i></button>
                                </form>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <div class="pagination">
                {{ $tapas->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/search.js') }}"></script>

    <script>
        function confirmDelete(url) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                window.location.href = url;
            }
        }
    </script>
@endpush
