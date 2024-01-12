@extends('layouts.app')

@section('content')
    @role('admin')

        <div class="container" style="margin-top: 20px;">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                        <script>
                            function cerrarAlerta() {
                                document.getElementById("alerta").style.display = "none";
                            }

                            function clearSearchInput() {
                                document.getElementById("searchInput").value = '';
                            }
                        </script>
                    @endif

                    {{-- <form action="{{ route('bar_tapa.search') }}" method="GET" class="form-inline mt-3 mb-3"
                        onsubmit="clearSearchInput()">
                        <div class="d-flex justify-content-between w-100">
                            <div class="form-group flex-fill ml-2" style="margin-right: 10px;">
                                <input type="text" name="search" class="form-control" placeholder="Buscar"
                                    value="{{ $search }}" id="searchInput">
                            </div>
                            <button type="submit" class="btn btn-primary" id="searchButton">Buscar</button>
                        </div>
                    </form> --}}
                    @if (empty($search))
                        <a href="{{ route('bar_tapa.dashboard') }}" class="btn mb-3 mt-3 shadow"
                            style="background-color: #a5b6a5; color: white;"><i
                                class="fa fa-fw fa-lg fa-arrow-left"></i>Dashboard</a>&nbsp;&nbsp;
                        <a href="{{ route('bar_tapa.create') }}" class="btn mb-3 mt-3"
                            style="background-color: var(--bs-blue); color: white;">Asigna Tapa</a>
                    @endif

                    @if (!empty($search))
                        <a href="{{ route('bar_tapa.index') }}" class="btn mb-3 mt-3"
                            style="background-color: var(--bs-blue); color: white;">Regresar</a><br><br>
                    @endif
                    <div class="table-responsive">
                        <table
                            class="table table-striped 
                table-hover table-borderless 
                table-secondary 
                align-middle">
                            <thead class="table-light">
                                <caption>Lista de tapas asociadas a bares</caption>
                                <tr>
                                    {{-- <th scope="col">ID</th> --}}
                                    <th scope="col">Foto</th>
                                    <th scope="col">Tapa</th>
                                    <th scope="col">Bar</th>
                                    <th scope="col">Acciones</th>
                                    <th scope="col">Localización</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (isset($grouped_tapas))
                                    @foreach ($grouped_tapas as $bar => $tapas)
                                        <tr class="table-light">
                                            {{-- <td>{{ $tapa->id }} </td> --}}
                                            <td><img class="img-fluid img-thumbnail"
                                                    src="{{ asset('storage' . '/' . $tapas[0]['tapa']->img) }}" width="200px"
                                                    alt="{{ $tapas[0]['tapa']->name }}"></td>
                                            <td><strong>{{ $tapas[0]['tapa']->name }}</strong></td>
                                            <td><strong>{{ $bar }}</strong> <br></td>
                                            <td>
                                                @foreach ($tapas as $tapaItem)
                                                    <form action="{{ route('bar_tapa.edit', $tapaItem['bartapa_Id']) }}"
                                                        class="d-inline" method="get">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Editar</button>
                                                        &nbsp;|&nbsp;
                                                    </form>
                                                    <form action="{{ route('bar_tapa.destroy', $tapaItem['bartapa_Id']) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('¿Estás seguro de eliminar este registro?')">Borrar</button>
                                                    </form>
                                                    {{-- &nbsp;|&nbsp;

                                                    <form action="{{ route('bar_tapa.show', $tapaItem['bartapa_Id']) }}"
                                                        class="d-inline" method="get">
                                                        @csrf
                                                        <input class="btn btn-warning" type="submit" value="Mostrar">
                                                    </form> --}}
                                                @endforeach
                                            </td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="{{route('bar_tapa.show', $tapaItem['bartapa_Id']) }}" class="btn shadow"
                                                    style="background-color: var(--bs-blue); color: white; display: inline-block; line-height: 20px;"
                                                    title="Ver Mapa" onmouseover="this.style.backgroundColor='#f1458d'"
                                                    onmouseout="this.style.backgroundColor='var(--bs-blue)'"">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="pagination">
                            {{ $bar_tapas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endrole
