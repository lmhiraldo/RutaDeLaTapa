<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Bares en PDF</title>

    <style>
        h1 {

            font-family: Arial, sans-serif;
            font-size: 30px;
            text-align: center;
            font-weight: bold;


        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #9c9a96f8;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #e7e6e6f8;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>

<body>
    <div class="table-responsive">

        <h1>Lista de bares</h1>
        <table
            class="table table-striped
        table-hover	
        table-borderless
        table-secondary
        align-middle">
            <thead class="table-light">
                < <tr>
                    {{-- <th scope="col">Bar_id</th> --}}
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción </th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Horario</th>
                    </tr>
            </thead>

            <tbody class="table-group-divider">

                @foreach ($bars as $bar)
                    <tr class="table-light">
                        {{-- <td>{{$bar->id}}</td> --}}
                        <td>{{ $bar->name }}</td>
                        <td>{{ $bar->description }}</td>
                        <td> {{ $bar->address }}</td>
                        <td>{{ $bar->phone }} </td>
                        <td>{{ $bar->opening_hours }} </td>

                    </tr>
                @endforeach

            </tbody>
            <tfoot>

            </tfoot>
        </table>




</body>

</html>
