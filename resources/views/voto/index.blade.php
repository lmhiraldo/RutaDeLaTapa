@extends('layouts.app')

@section('content')
    @unlessrole('admin')

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
                    @endif
                    <a href="{{ route('cookies.dashboard') }}" class="btn mb-3 mt-3 shadow"
                        style="background-color: #a5b6a5; color: white;"><i
                            class="fa fa-fw fa-lg fa-arrow-left"></i>Dashboard</a>&nbsp;&nbsp;
                    <a href="{{ route('voto.user-voto') }}" class="btn mb-3 mt-3"
                        style="background-color: var(--bs-blue);color: white;">Tus Votos</a>

                    <div class="table-responsive">
                        <table
                            class="table table-striped table-hover table-borderless table-secondary align-middle table-bordered">
                            <thead class="table-light">
                                <caption>Lista de tapas asociadas a bares</caption>
                                <tr>
                                    <th scope="col" class="text-center">Foto</th>
                                    <th scope="col" class="text-center">Tapa</th>
                                    <th scope="col" class="text-center">Bar</th>
                                    <th scope="col" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @if (isset($grouped_tapas))
                                    @foreach ($grouped_tapas as $bar => $tapas)
                                        <tr class="table-light">
                                            <td class="text-center"><img class="img-fluid img-thumbnail"
                                                    src="{{ asset('storage/' . $tapas[0]['tapa']->img) }}" width="200px"
                                                    alt="{{ $tapas[0]['tapa']->name }}"></td>
                                            <td class="text-center"><strong>{{ $tapas[0]['tapa']->name }}</strong></td>
                                            <td class="text-center"><strong>{{ $bar }}</strong> <br></td>
                                            <td class="text-center">
                                                @foreach ($tapas as $tapaItem)
                                                    <a href="{{ route('voto.create', $tapaItem['bartapa_Id']) }}"
                                                        class="btn btn-success mb-3 mt-3">Vota</a>
                                                @endforeach
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

@endunless
