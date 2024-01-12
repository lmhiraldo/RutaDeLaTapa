<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Voto;
use App\Models\Bar_Tapa;
use Illuminate\Pagination\LengthAwarePaginator;
use Cookie;


class CookiesController extends Controller
{
    //

     /*------------Crear las cookies-----------------*/ 

     public function setCookie()
     {
         if (!request()->hasCookie('cookie_consent')) {           
             Cookie::queue('cookie_consent', 'aceptado', 1440);
         } 
         return redirect('/');
     }
      
      

 /*------------Extraer las cookies-----------------*/
    public function getCookie (){
        return request()->cookie('cookie_consent');    }

    /*------------Borrar cookies-----------------*/

public function delCookie()
{
    return redirect()->route('cookies_required')->withCookie(cookie()->forget('cookie_consent'))->withSession(['cookie_consent' => false]);
}

/*-----------------Método Index------------------------------------------------------------- */

public function index()
    { 
        $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->get();
        $grouped_tapas = [];
        
        foreach ($bar_tapas as $tapa) {
            foreach ($tapa->bars as $bar) {
                $bartapa_Id = $bar->pivot->id; // Obtiene el bartapa_Id de la relación intermedia            
                $grouped_tapas[$bar->name][] = [
                    'tapa' => $tapa,
                    'bartapa_Id' => $bartapa_Id,
                    'address' => $bar->address,
                    'opening_hours' =>$bar-> opening_hours,
                ];
            }
             
        }
        
        return view('cookies.dashboard', compact('grouped_tapas', 'bar_tapas'));
    }

public function totalVotos()
{
    // Obtén todas las relaciones "bar_tapa" con las relaciones "votos" cargadas
    $barTapas = Bar_Tapa::with('votos', 'bars', 'tapas')
        ->get()
        ->sortByDesc(function ($barTapa) {
            return $barTapa->votos->sum('rating');
        });
    // Pagina los resultados después de ordenarlos
    $perPage = 6;
    $currentPage = request()->input('page', 1);
    $pagedData = array_slice($barTapas->all(), ($currentPage - 1) * $perPage, $perPage);
    $barTapas = new LengthAwarePaginator($pagedData, count($barTapas), $perPage, $currentPage);

    $barTapaWithTotalVotos = [];

    foreach ($barTapas as $barTapa) {
        $totalVotos = $barTapa->votos->sum('rating');
        // Cargamos desde los modelos Tapa y Bar directamente
        $tapa = Tapa::find($barTapa->tapa_id);
        $bar = Bar::find($barTapa->bar_id);

        //Obtenemos los comentarios asociados a cada barTapa_Id específica
        $comentarios = Voto::where('bar_tapa_id', $barTapa->id)
            ->whereNotNull('comment')
            ->get();

        // Convierte la puntuación en estrellas utilizando la función convertToStars
        $stars = $this->convertToStars($totalVotos);

        $barTapaWithTotalVotos[] = [
                        'voto' => $barTapa->votos,
                        'tapa' => $tapa ? $tapa->name : 'No asignado',
                        'description' => $tapa ? $tapa->description : 'Sin descripción', 
                        'img' => $tapa ? $tapa->img : 'No asignado',
                        'bar' => $bar ? $bar->name : 'No asignado',
                        'bartapa_Id' => $barTapa->id,
                        'address' => $bar ? $bar->address : 'No asignado',
                        'opening_hours' => $bar ? $bar->opening_hours : 'No asignado',
                        'totalVotos' => $totalVotos,
                        'comments' => $comentarios,
                        'stars' => $this->convertToStars($totalVotos), // Agregamos la puntuación en estrellas
                    ];        
    }

    return view('cookies.dashboard', compact('barTapaWithTotalVotos', 'barTapas'));
}

private function convertToStars($rating)
{
    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $stars .= '★'; // ★ representa una estrella
        } else {
            $stars .= '☆'; // ☆ representa una estrella vacía
        }
    }
    return $stars;

}


}