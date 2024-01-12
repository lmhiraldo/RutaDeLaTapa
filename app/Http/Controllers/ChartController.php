<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tapa;

class ChartController extends Controller
{
    
    public function chartbar(){        
        
        $tapas= Tapa::orderBy('price','asc')->get();//ordenamos de manera ascendente 

        return view('tapa.chart',['tapas'=>$tapas]);
    }
}