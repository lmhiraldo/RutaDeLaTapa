@extends('layouts.app')

@section('content')
    {{-- @role('admin') --}}

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


                    @if (empty($search))
                        <a href="{{ route('bar_tapa.index') }}" class="btn mb-3 mt-3"
                            style="background-color: var(--bs-blue);color:white; ">Gestión
                            de Bares y Tapas</a>
                        <a href="{{ route('tapa.index') }}" class="btn mb-3 mt-3"
                            style="background-color: var(--bs-green);color:white; ">Lista
                            de Tapas</a>
                        <a href="{{ route('bar.index') }}" class="btn mb-3 mt-3"
                            style="background-color: var(--bs-warning); font-weight: bold; ">Bares
                            Asociados</a>
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
                                    {{-- <th scope="col">Acciones</th> --}}
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

{{-- @endrole --}}
