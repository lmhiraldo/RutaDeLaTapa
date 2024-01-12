<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TapaController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BarController;
use App\Http\Controllers\BarTapaController;
use App\Http\Controllers\CookiesController;
use App\Http\Controllers\VotoController;
use App\Http\Controllers\MapController;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*----------------------CookiesController---------------------------------------------- */
Route::get('/', [CookiesController::class, 'totalVotos'])->name('cookies.dashboard');
Route::get('/setCookie', [CookiesController::class, 'setCookie'])->name('setCookie');
Route::get('/get-cookie',[CookiesController::class,'getCookie']);
Route::get('/del-cookie',[CookiesController::class,'delCookie']);
Route::get('/cookies_required', function () {
    return view('cookies.cookies_required');
})->name('cookies_required');
Route::get('/ruta', [CookiesController::class, 'ruta'])->name('cookies.ruta');


Auth::routes();

Route::get('/voto/totalVotos', [VotoController::class, 'totalVotos'])->name('voto.totalVotos');

/*------------------------MapOntroller---------------------------------------------*/

Route::get('/map/{id}/coordinates', [MapController::class, 'getCoordinates']);
Route::get('/map/{id}', [MapController::class, 'showMap'])->name('map');

/*----------------------Rutas con autorización------------------------------------------------------ */


Route::group(['middleware' => 'auth'], function () {    

    /*---------------------Rutas TapaController-------------------------------------*/
    Route::get('/tapa/chartbar', [App\Http\Controllers\ChartController::class, 'chartbar'])->name('tapa.chart'); 
    Route::get('/tapa/pdf', [App\Http\Controllers\TapaController::class, 'pdf'])->name('tapa.pdf');
    Route::resource('tapa', TapaController::class); 
    Route::get('/tapa', [TapaController::class, 'index'])->name('tapa.index');         
        

    /*---------------------Rutas BarController-------------------------------------*/ 
    Route::get('/bar/pdf', [App\Http\Controllers\BarController::class, 'pdf'])->name('bar.pdf'); 
    Route::get('/bar/{barId}/coordinates', [BarController::class, 'getCoordinates']);      
    Route::get('/bars', [BarController::class, 'index'])->name('bar.index'); 
    Route::get('/bars/create', [BarController::class, 'create'])->name('bar.create');  
    Route::post('/bars', [BarController::class, 'store'])->name('bar.store');
    Route::get('/bars/{id}/edit', [BarController::class, 'edit'])->name('bar.edit');
    Route::patch('/bars/{id}', [BarController::class, 'update'])->name('bar.update');
    Route::get('/bars/{id}', [BarController::class, 'show'])->name('bar.show');
    Route::delete('/bars/{id}', [BarController::class, 'destroy'])->name('bar.delete');

     /*-------------------------Rutas BarTapaController--------------------------*/
    
    
    // Ruta para mostrar una lista de bares asociados a tapas
    Route::get('/bar_tapa', [BarTapaController::class, 'index'])->name('bar_tapa.index');
    // Tablón de entrada
    Route::get('/bar_tapa/indexDashboard', [BarTapaController::class, 'indexDashboard'])->name('bar_tapa.dashboard');    
    //Ruta para el metodo search
    Route::get('/bar_tapa/search', [BarTapaController::class, 'search'])->name('bar_tapa.search');
    
    // Ruta para mostrar el formulario de creación de una relación entre bar y tapa
    Route::get('/bar_tapa/create', [BarTapaController::class, 'create'])->name('bar_tapa.create');
    
    // Ruta para almacenar la relación entre bar y tapa en la base de datos
    Route::post('/bar_tapa', [BarTapaController::class, 'store'])->name('bar_tapa.store');
    
    // Ruta para mostrar los detalles de una relación específica entre bar y tapa
    Route::get('/bar_tapa/{id}', [BarTapaController::class, 'show'])->name('bar_tapa.show');
    
    // Ruta para mostrar el formulario de edición de una relación entre bar y tapa
    Route::get('/bar_tapa/{id}/edit', [BarTapaController::class, 'edit'])->name('bar_tapa.edit');
    
    // Ruta para actualizar una relación entre bar y tapa en la base de datos
    Route::put('/bar_tapa/{id}', [BarTapaController::class, 'update'])->name('bar_tapa.update');
    
    // Ruta para eliminar una relación entre bar y tapa
    Route::delete('/bar_tapa/{id}', [BarTapaController::class, 'destroy'])->name('bar_tapa.destroy');
    //Ruta para coordenadas
    Route::get('/bar_tapa/{id}/coordinates', [BarTapaController::class, 'getCoordinates']);
    
   



    /*-------------------------------VotoController-----------------------------------------------*/
    Route::get('/voto', [VotoController::class,'index'])->name('voto.index');
    
    Route::post('/voto', [VotoController::class,'store'])->name('voto.store'); 
   
    Route::get('/voto/create/{id}', [VotoController::class,'create'])->name('voto.create');
    Route::get('/voto/{id}/edit', [VotoController::class,'edit'])->name('voto.edit');
    Route::put('/voto/{id}', [VotoController::class,'update'])->name('voto.update'); 
    Route::get('/user-voto', [VotoController::class, 'getUserVotos'])->name('voto.user-voto');
    Route::delete('/voto/{id}', [VotoController::class, 'destroy'])->name('voto.destroy');
   
    


});