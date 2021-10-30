<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parqueadero;
use App\Services\GoogleMaps;

class ParqueaderoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parqueaderos = Parqueadero::get();
        return response()->json($parqueaderos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombre = $request->get('nombre');
        $direccion = $request->get('direccion');
        $localizacion = GoogleMaps::calcularLatitudLongitud($direccion);

        $data = [
            'Nombre' => $nombre,
            'Ubicacion' => $direccion,
            'latitud' => $localizacion['latitud'],
            'longitud' => $localizacion['longitud'],
        ];

        $parqueadero = Parqueadero::create($data);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }
        
        return response()->json($parqueadero);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nombre = $request->get('nombre');
        $direccion = $request->get('direccion');
        $localizacion = GoogleMaps::calcularLatitudLongitud($direccion);

        $data = [
            'Nombre' => $nombre,
            'Ubicacion' => $direccion,
            'latitud' => $localizacion['latitud'],
            'longitud' => $localizacion['longitud'],
        ];

        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $parqueadero->update($data);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $parqueadero->delete();
        return response()->json([ 'deleted' => true ]);
    }
}
