<form action="{{ url('bars') }}" method="POST" enctype="multipart/form-data">

    <h2>{{ $modo }} Bar</h2>

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
            <label for="name" class="form-label"><strong>Nombre</strong></label>
            <input type="text" class="form-control" name="name"
                value="{{ isset($bar->name) ? $bar->name : old('name') }}" id="name">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="description" class="form-label"><strong>Descripción</strong> </label>
            <input type="text" class="form-control" name="description"
                value="{{ isset($bar->description) ? $bar->description : old('description') }}" id="description">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="address" class="form-label"><strong>Dirección</strong> </label>
            <input type="text" class="form-control" name="address"
                value="{{ isset($bar->address) ? $bar->address : old('address') }}" id="address">
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="phone" class="form-label"><strong>Teléfono</strong> </label>
            <input type="text" class="form-control" name="phone"
                value="{{ isset($bar->phone) ? $bar->phone : old('phone') }}" id="phone">
        </div>
    </div>

    <div class="form-group">
        <div class="mb-3">
            <label for="opening_hours" class="form-label"><strong>Horario </strong> </label>
            <input type="text" class="form-control" name="opening_hours"
                value="{{ isset($bar->opening_hours) ? $bar->opening_hours : old('opening_hours') }}"
                id="opening_hours">
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="latitude" class="form-label"><strong>Latitud</strong></label>
            <input type="text" class="form-control" name="latitude"
                value="{{ isset($bar->latitude) ? $bar->latitude : old('latitude') }}" id="latitude">
        </div>
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="longitude" class="form-label"><strong>Longitud</strong></label>
            <input type="text" class="form-control" name="longitude"
                value="{{ isset($bar->longitude) ? $bar->longitude : old('longitude') }}" id="longitude">
        </div>
    </div>

    <a href="{{ url('bars/') }}" class="btn" style="background-color: var(--bs-blue);color:white;"><i
            class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>
    <input class="btn btn-success" type="submit" value="{{ $modo }} bar">



</form>
