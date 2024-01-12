<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar_Tapa;
use App\Models\Bar;
use App\Models\Tapa;

class MapController extends Controller
{
    public function showMap($id)
    {
        $barTapa = Bar_Tapa::find($id);
    
        if (!$barTapa) {
            return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
        }
    
        // Obtén los detalles de la tapa y el bar relacionados con este barTapa
        $bar = Bar::find($barTapa->bar_id);
    
        return view('map.map', compact('barTapa', 'bar'));  
     }


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