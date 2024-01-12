@extends('layouts.app')

@section('template_title')
    {{ $bar->name ?? __('Detalle del Bar') }}
@endsection

@section('content')
    <section class="content container-fluid h-100" style="margin-top: 20px;">

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5" data-bar-id="{{ $bar->id }}">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ __('Detalle del Bar') }}</strong>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-1">
                            <strong>Nombre: </strong>
                            <strong> {{ $bar->name }} </strong>
                        </div>
                        <div class="form-group mb-1">
                            <strong>Descripción: </strong>
                            {{ $bar->description }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Dirección: </strong>
                            {{ $bar->address }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Teléfono: </strong>
                            {{ $bar->phone }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Horario: </strong>
                            {{ $bar->opening_hours }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row h-100 justify-content-center align-items-center mt-3">
            <div class="col-md-5">
                <div id="myMap" style="height: 400px; width: 100%;"></div>
            </div>
        </div>

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-3 ml-3">
                    <a class="btn" style="background-color: var(--bs-blue); color: white;"
                        href="{{ route('bar_tapa.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        const titleProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

        const barId = '{{ $bar->id }}';

        fetch(`/bar/${barId}/coordinates`)
            .then(response => response.json())
            .then(data => {
                let myMap = L.map('myMap').setView([data.latitude, data.longitude], 18);
                L.tileLayer(titleProvider, {
                    maxZoom: 19,
                    attribution: 'Leaflet &copy; <a href="http://www.openstreetmap.org/copyright">RutaDeLaTapa</a>'
                }).addTo(myMap);

                const marker = L.marker([data.latitude, data.longitude]).addTo(myMap);

                const popupContent = `
                    <div>
                        <h5><strong>{{ $bar->name }}</strong></h5>
                        <p><strong>{{ $bar->address }}</strong></p>
                    </div>
                `;

                function togglePopup() {
                    if (marker.isPopupOpen()) {
                        marker.closePopup();
                    } else {
                        marker.bindPopup(popupContent).openPopup();
                    }
                }

                marker.on('click', togglePopup);
                // Abre automáticamente el mensaje emergente al cargar el mapa
                marker.bindPopup(popupContent).openPopup();

                myMap.on('click', function(e) {
                    marker.bindPopup(popupContent).openPopup();
                });

                const accuracy = 20;
                const circle = L.circle([data.latitude, data.longitude], {
                    radius: accuracy
                }).addTo(myMap);

                let zoomed = false;
                if (!zoomed) {
                    zoomed = myMap.fitBounds(circle.getBounds());
                }

            })
            .catch(error => console.error('Error:', error));
    </script>
@endsection
