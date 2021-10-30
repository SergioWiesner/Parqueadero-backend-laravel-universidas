<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* personas */
Route::resource("personas", \App\Http\Controllers\PersonaController::class);
/* vehiculos */
Route::resource("vehiculos", \App\Http\Controllers\VehiculoController::class);
/* tipo-vehiculos */
Route::resource("tipo-vehiculos", \App\Http\Controllers\TipoVehiculoController::class);
/* tarifa */
Route::resource("tarifa", \App\Http\Controllers\TarifaController::class);
/* parqueaderos */
Route::resource('parqueaderos', \App\Http\Controllers\ParqueaderoController::class);