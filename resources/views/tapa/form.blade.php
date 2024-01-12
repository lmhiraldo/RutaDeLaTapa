<form action="{{ url('tapa') }}" method="POST" enctype="multipart/form-data">

    <h2>{{ $modo }} Tapa</h2>

    @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>


    @endif

    <div class="form-group">

        <div class="mb-3">
            <label for="name" class="form-label"><strong>Nombre: </strong></label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($tapa->name) ? $tapa->name : old('name') }}" id="name">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3 ">
            <label for="img" class="form-label"></label>
            @if (isset($tapa->img))
                <img class="img-fluid img-thumbnail my-3" src="{{ asset('storage' . '/' . $tapa->img) }}" width="200px"
                    alt="croqueta">
            @endif
            <input type="file" name="img" value="" id="img" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="description" class="form-label"><strong>Descripción: </strong> </label>
            <input type="text" class="form-control" name="description"
                value="{{ isset($tapa->description) ? $tapa->description : old('description') }}" id="description">
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="price" class="form-label"><strong>Precio € :</strong> </label>
            <input type="number" class="form-control" name="price"
                value="{{ isset($tapa->price) ? $tapa->price : old('price') }}" id="price" step="0.01"
                min="0">
        </div>
    </div>
    <a href="{{ url('tapa/') }}" class="btn" style="background-color: var(--bs-blue);color:white;"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>
    <input class="btn btn-success" type="submit" value="{{ $modo }} tapa">




</form>
