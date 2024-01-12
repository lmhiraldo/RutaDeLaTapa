<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Bar_Tapa;




class BarTapaController extends Controller
{
   
public function index()
{ 
    $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->paginate(2);
    $grouped_tapas = [];
    $search = '';
    
    foreach ($bar_tapas as $tapa) {
        foreach ($tapa->bars as $bar) {
            $bartapa_Id = $bar->pivot->id; // Obtiene el bartapa_Id de la relación intermedia
            $grouped_tapas[$bar->name][] = [
                'tapa' => $tapa,
                'bartapa_Id' => $bartapa_Id,
            ];
        }         
    }
    
    return view('bar_tapa.index', compact('grouped_tapas', 'bar_tapas', 'search'));
}

public function indexDashboard()
{ 
    $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->paginate(2);
    $grouped_tapas = [];
    $search = '';
    
    foreach ($bar_tapas as $tapa) {
        foreach ($tapa->bars as $bar) {
            $bartapa_Id = $bar->pivot->id; // Obtiene el bartapa_Id de la relación intermedia
            $grouped_tapas[$bar->name][] = [
                'tapa' => $tapa,
                'bartapa_Id' => $bartapa_Id,
            ];
        }         
    }
    
    return view('bar_tapa.dashboard', compact('grouped_tapas', 'bar_tapas', 'search'));
}

/*---------------------------------------Buscar/Search.................................. */
public function search(Request $request)
{
    $search = $request->input('search', ''); // Obtener el término de búsqueda
    // dd($search);
    // Realizar la búsqueda si se ha proporcionado un término de búsqueda
    if (!empty($search)) {
        $bar_tapas = Tapa::where('name', 'LIKE', "%$search%")
            // ->orWhere('description', 'LIKE', "%$search%")
            ->whereHas('bars')
            ->with(['bars'])
            ->paginate(5);
    } else {
        // Mostrar todas las tapas si no se ha proporcionado un término de búsqueda
        $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->paginate(5);
    }

    return view('bar_tapa.index', compact('bar_tapas', 'search'))
        ->with('i', (request()->input('page', 1) - 1) * $bar_tapas->perPage())
        ->with('search', $search);
}



/*------------------Crear--------------------------------*/

public function create()
    {
        $bars = Bar::pluck('name', 'id');
        $tapas = Tapa::pluck('name', 'id');

        return view('bar_tapa.create', compact('bars','tapas'));
    }


public function store(Request $request)
{
   
    $rules = [
        'tapas' => 'required|array|min:1',
        'bars' => 'required|array|min:1'
        
    ];

    $messages = [
        'tapas.required' => 'Debe seleccionar al menos una tapa',
        'bars.required' => 'Debe seleccionar al menos un bar'
    ];

    $this->validate($request, $rules, $messages);

    $tapas = $request->input('tapas');
    $bars = $request->input('bars');

    foreach ($tapas as $tapa) {
        foreach ($bars as $bar) {
            // Verifica si ya existe una relación entre la tapa y el bar
            $existingRelation = Bar_Tapa::where('tapa_id', $tapa)->where('bar_id', $bar)->first();

            if (!$existingRelation) {
                // Si no existe la relación, crea un nuevo registro en la tabla bar_tapa
                $bar_tapa = new Bar_Tapa;
                $bar_tapa->tapa_id = $tapa;
                $bar_tapa->bar_id = $bar;
                $bar_tapa->save();
            }else{
                // Si la relación ya existe, muestra un mensaje de error y redirecciona
                if ($existingRelation) {
                return redirect()
        ->route('bar_tapa.index')
        ->with('error', 'La relación ya existe.'); // Agrega un mensaje de error
}
            }
        }
    }

       
    // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa.index')->with('success', 'Relación asignada exitosamente.');
}

/*----------------------Método Editar --------------------*/
public function edit($id)
{
    $barTapa = Bar_Tapa::find($id);
    
    if (!$barTapa) {
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }

    $bars = Bar::pluck('name', 'id');
    $tapas = Tapa::pluck('name', 'id');

    return view('bar_tapa.edit', compact('barTapa', 'bars', 'tapas'));
}
  
/*-----------------Update----------------------------------*/

public function update(Request $request, $id)
{
    $rules = [
        'tapa_id' => 'required|exists:tapas,id',
        'bar_id' => 'required|exists:bars,id'
    ];

    $messages = [
        'tapa_id.required' => 'Debe seleccionar una tapa',
        'bar_id.required' => 'Debe seleccionar un bar'
    ];

    $this->validate($request, $rules, $messages);

    $barTapa = Bar_Tapa::find($id);

    if (!$barTapa) {
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }

    // Actualiza la relación en la tabla pivote con los nuevos valores
    $barTapa->tapa_id = $request->input('tapa_id');
    $barTapa->bar_id = $request->input('bar_id');
    $barTapa->save();

    return redirect()->route('bar_tapa.index')->with('success', 'Relación modificada exitosamente.');
}


/*------------------Delete--------------------------------*/

public function destroy($id)
{
    // Busca la relación en la tabla pivote por su ID
    $barTapa = Bar_Tapa::find($id);

    //dd($barTapa);

    if (!$barTapa) {
        // Maneja el caso en el que la relación no existe
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }

    // Elimina la relación en la tabla pivote
    $barTapa->delete();

    // Redirecciona a la vista bar_tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa.index')->with('success', 'Relación eliminada exitosamente.');
}

/*----------------------Método Mostrar --------------------------------------------------------------- */
public function show($id)
{
    $barTapa = Bar_Tapa::find($id);

    if (!$barTapa) {
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }

    // Obtén los detalles de la tapa y el bar relacionados con este barTapa
    $tapa = Tapa::find($barTapa->tapa_id);
    $bar = Bar::find($barTapa->bar_id);

    return view('bar_tapa.show', compact('barTapa', 'tapa', 'bar'));
}

/*-------------------Geolocalización------------------------------- */
public function getCoordinates($id)
{
    $barTapa = Bar_Tapa::find($id);

    if (!$barTapa) {
        return response()->json(['error' => 'Bar_Tapa not found'], 404);
    }

    $bar = Bar::find($barTapa->bar_id);

    if (!$bar) {
        return response()->json(['error' => 'Bar not found'], 404);
    }

    $coordinates = [
        'latitude' => $bar->latitude,
        'longitude' => $bar->longitude,
    ];

    return response()->json($coordinates);
}





}