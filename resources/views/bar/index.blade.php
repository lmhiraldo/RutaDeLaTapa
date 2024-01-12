@extends('layouts.app')

@section('content')
    <div class="container">


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

                function clearSearchInput() {
                    document.getElementById("searchInput").value = '';
                }
            </script>
        @endif
        <form action="{{ route('bar.index') }}" method="GET" class="form-inline mt-3 mb-3" onsubmit="clearSearchInput()">
            <div class="d-flex justify-content-between w-100">
                <div class="form-group flex-fill ml-2" style="margin-right: 10px;">
                    <input type="text" name="search" class="form-control" placeholder="Buscar bares"
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
            <a href="{{ url('bars/create') }}" class="btn"
                style="background-color: var(--bs-blue); color: white;">Registrar nuevo bar</a>&nbsp;&nbsp;
            <a href="{{ url('bar/pdf') }}" class="btn btn-warning float-right">PDF</a>&nbsp;&nbsp;
            <br>
        @endif

        @if (!empty($search))
            <a href="{{ route('bar.index') }}" class="btn"
                style="background-color: var(--bs-blue); color: white;">Regresar</a><br><br>
        @endif


        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless table-secondary align-middle">
                <thead class="table-light">
                    <caption>Lista de bares</caption>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Acciones</th>
                        <th scope="col">Localización</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($bars as $bar)
                        <tr class="table-light">
                            <td><strong>{{ $bar->name }}</strong></td>
                            <td>{{ $bar->description }}</td>
                            <td>{{ $bar->address }}</td>
                            <td>{{ $bar->phone }}</td>
                            <td>{{ $bar->opening_hours }}</td>
                            <td>
                                @if (Auth::check())
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <a href="{{ url('/bars/' . $bar->id . '/edit') }}"
                                            class="btn btn-success">Editar</a> &nbsp;|&nbsp;
                                        <button class="btn btn-danger"
                                            onclick="confirmDelete('{{ url('/bars/' . $bar->id) }}')">Borrar</button>
                                        {{-- &nbsp;|&nbsp;
                                        <form action="{{ url('/bars/' . $bar->id) }}" method="get" class="d-inline">
                                            @csrf
                                            <button class="btn btn-warning" type="submit">Mostrar</button>
                                        </form> --}}
                                    </div>
                                @endif

                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('bar.show', $bar->id) }}" class="btn shadow"
                                    style="background-color: var(--bs-blue); color: white; display: inline-block; line-height: 20px;"
                                    title="Ver Mapa" onmouseover="this.style.backgroundColor='#f1458d'"
                                    onmouseout="this.style.backgroundColor='var(--bs-blue)'"">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </a>


                            </td>




                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $bars->links() !!}
        </div>
    </div>
    <script>
        function confirmDelete(url) {
            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                window.location.href = url;
            }
        }
    </script>
@endsection
