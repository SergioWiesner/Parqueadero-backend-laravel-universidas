<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParqueaderoController;

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

Route::post('/parqueadero', [ParqueaderoController::class, 'create']);

Route::get('/parqueaderos', [ParqueaderoController::class, 'list']);

Route::get('/parqueadero/{id}', [ParqueaderoController::class, 'get']);

Route::put('/parqueadero/{id}', [ParqueaderoController::class, 'update']);

Route::delete('/parqueadero/{id}', [ParqueaderoController::class, 'delete']);
