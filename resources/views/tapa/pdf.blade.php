<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Tapas en PDF</title>

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
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>

<body>
    <div class="table-container">
        <h1>Lista de tapas</h1>
    </div>
    <div class="table-responsive">
        <table
            class="table table-striped
        table-hover	
        table-borderless
        table-secondary
        align-middle">

            <thead class="table-light">


                {{-- <th scope="col">Tapa_id</th> --}}
                <th scope="col">Foto</th>
                <th scope="col">Nombre </th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>

                </tr>
            </thead>

            <tbody class="table-group-divider">

                @foreach ($tapas as $tapa)
                    <tr class="table-light">

                        {{-- <td>{{$tapa->id}}</td> --}}
                        <td>
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage' . '/' . $tapa->img) }}"
                                width="200px" alt="">
                        </td>

                        <td>{{ $tapa->name }}</td>
                        <td>{{ $tapa->description }}</td>
                        <td>{{ $tapa->price }} € </td>

                    </tr>
                @endforeach

            </tbody>
            <tfoot>

            </tfoot>
        </table>


</body>

</html>
