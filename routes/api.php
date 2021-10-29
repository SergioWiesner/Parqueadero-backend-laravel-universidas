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
Route::resource("personas", \App\Http\Controllers\Persona::class);
/* vehiculos */
Route::resource("vehiculos", \App\Http\Controllers\Vehiculo::class);
/* tipo-vehiculos */
Route::resource("tipo-vehiculos", \App\Http\Controllers\TipoVehiculo::class);
/* tarifa */
Route::resource("tarifa", \App\Http\Controllers\Tarifa::class);
