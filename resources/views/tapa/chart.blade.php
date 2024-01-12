@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">

        <head>
            <title>Google Bar Chart</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        </head>

        <body>
            <div class="mt-4">
                <h1 class="text-center">Precio de las Tapas</h1>
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('tapa.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        {{ __('Ir a lista de tapas') }}</a>
                </div>
                <div class="container-fluid p-5">
                    <div id="barchart" class="w-100" style="height: 500px;"></div>
                </div>
            </div>

            <h1 class="text-center mt-4">Precio de las Tapas</h1>

            <div id="piechart" class="w-100" style="height: 500px;"></div>

            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar', 'corechart']
                });
                google.charts.setOnLoadCallback(drawCharts);

                function drawCharts() {
                    var barData = google.visualization.arrayToDataTable([
                        ['Tapa_id', 'Nombre Tapa', 'Precio'],
                        @foreach ($tapas as $tapa)
                            ['{{ $tapa->id }}', '{{ $tapa->name }}', {{ $tapa->price }}],
                        @endforeach
                    ]);

                    var barOptions = {
                        chart: {
                            title: 'Gráfica de Barras',
                            subtitle: 'Comparación de Precios',
                        },
                        bars: 'vertical',
                    };

                    var pieData = google.visualization.arrayToDataTable([
                        ['Nombre Tapa', 'Precio'],
                        @foreach ($tapas as $tapa)
                            ['{{ $tapa->name }}', {{ $tapa->price }}],
                        @endforeach
                    ]);

                    var pieOptions = {
                        title: 'Gráfica Circular',
                        titleTextStyle: {
                            color: '#333',
                            fontSize: 18,
                            fontWeight: 'bold'
                        },
                    };

                    var barChart = new google.charts.Bar(document.getElementById('barchart'));
                    barChart.draw(barData, google.charts.Bar.convertOptions(barOptions));

                    var pieChart = new google.visualization.PieChart(document.getElementById('piechart'));
                    pieChart.draw(pieData, pieOptions);
                }
            </script>
        </body>
    </div>
@endsection
