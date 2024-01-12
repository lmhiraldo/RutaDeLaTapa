@extends('layouts.app')

@section('content')
    <!-- Leaflet CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet Routing Machine CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleMap.css') }}">

    <div id='map'></div>

    <div class="formBlock" style="margin-top: 50px;">
        <form id="form">
            <input type="text" name="start" class="input" id="start"
                placeholder="Ingrese la dirección de partida" />
            <button type="button" id="currentLocation" class="btn mt-3 shadow flex-fill"
                style="background-color: var(--bs-green); color: white; border: none; outline: none; border-radius: 3px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                Mi Ubicación Actual
            </button>

            <!-- Selector de modo de transporte -->
            <select id="modeSelector" class="form-select mt-3">
                <option value="car">En coche</option>
                <option value="foot">Caminando</option>
            </select>

            <div class="d-flex">
                <a href="{{ route('cookies.dashboard') }}" class="btn btn-secondary mt-3 shadow flex-fill"
                    style="border-radius: 3px;">
                    <i class="fa fa-fw fa-lg fa-arrow-left"></i>Tapas
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn mt-3 shadow flex-fill"
                    style="background-color: var(--bs-blue); color: white; border: none; outline: none; border-radius: 3px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                    Mostrar Ruta
                </button>
            </div>
        </form>
    </div>

    <!-- Leaflet JS CDN -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS CDN -->
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8">
    </script>

    <script>
        const tileProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        const initialPoint = L.latLng({{ $bar->latitude }}, {{ $bar->longitude }});

        let map = L.map('map').setView(initialPoint, 13);

        /*----------------------------Ubicación actual desde el icono show mw where I am---------------------*/

        let locateControl = L.control.locate({
            position: 'bottomleft',
            drawCircle: true,
            drawMarker: true,
            locateOptions: {
                enableHighAccuracy: true
            },
            cacheLocation: false
        }).addTo(map);

        locateControl._container.addEventListener('click', function() {
            locateControl.remove();
            locateControl = L.control.locate({
                position: 'bottomleft',
                drawCircle: true,
                drawMarker: true,
                locateOptions: {
                    enableHighAccuracy: true
                },
                cacheLocation: false
            }).addTo(map);
        });
        /*------------------------------------------------------------------------------------------------*/



        L.tileLayer(tileProvider, {
            maxZoom: 18,
            attribution: 'Leafletjs&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);



        let marker = L.marker(initialPoint, {
            icon: L.icon({
                iconUrl: 'http://localhost/RutaDeLaTapa/public/assets/img/position-point/red.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [1, -34]
            })
        }).addTo(map);

        function togglePopup() {
            if (marker.isPopupOpen()) {
                marker.closePopup();
            } else {
                marker.bindPopup(getPopupContent()).openPopup();
            }
        }

        function getPopupContent() {
            const startPointAddress = document.getElementById('start').value;
            return `
                <div>
                    <h5><strong>{{ $bar->name }}</strong></h5>
                    <p><strong>{{ $bar->address }}</strong></p>
                </div>
            `;
        }

        marker.on('click', togglePopup);
        marker.bindPopup(getPopupContent()).openPopup();

        const routeControl = L.Routing.control({
            waypoints: [
                initialPoint,
                initialPoint
            ],
            routeWhileDragging: true
        }).addTo(map);

        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            const startPointAddress = document.getElementById('start').value;
            const selectedMode = document.getElementById('modeSelector').value;
            let profile = 'car'; // Valor por defecto

            if (selectedMode === 'foot') {
                profile = 'foot';
                routeControl.getRouter().options.profile = profile;
            }

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${startPointAddress}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const startPointCoordinates = L.latLng(data[0].lat, data[0].lon);

                        routeControl.setWaypoints([
                            startPointCoordinates,
                            initialPoint
                        ]);

                        routeControl.getRouter().options.profile =
                            profile; // Establecer el perfil de transporte según la selección del usuario

                        marker.getPopup().setContent(getPopupContent());
                    } else {
                        console.error('No se encontraron coordenadas para la dirección ingresada.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        routeControl.on('routesfound', function(e) {
            const routes = e.routes;
            const coords = routes[0].coordinates;
            let index = 0;
            const moveMarker = setInterval(() => {
                marker.setLatLng(coords[index]);
                index++;
                if (index === coords.length) {
                    clearInterval(moveMarker);
                }
            }, 100);
        });

        marker.on('popupclose', function() {
            marker.unbindPopup().bindPopup(getPopupContent());
        });

        marker.on('popupopen', function() {
            marker.unbindPopup().bindPopup(getPopupContent());
        });

        document.getElementById('currentLocation').addEventListener('click', function() {
            const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            const success = function(position) {
                const userLocation = L.latLng(position.coords.latitude, position.coords.longitude);

                routeControl.setWaypoints([
                    userLocation,
                    initialPoint
                ]);

                marker.getPopup().setContent(getPopupContent(position.coords.latitude, position.coords
                    .longitude));
            };

            const error = function(error) {
                console.error('Error obteniendo la ubicación:', error.message);
            };

            const watchId = navigator.geolocation.watchPosition(success, error, options);
        });

        document.getElementById('currentLocation').addEventListener('click', function() {
            alert('La función de ubicación actual aún no está disponible.');
        });

        document.getElementById('modeSelector').addEventListener('change', function() {
            alert('La opción de ruta a pie aún no está disponible.');
        });
    </script>
@endsection
