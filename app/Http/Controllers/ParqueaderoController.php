<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParqueaderoRequest;
use App\Models\Parqueadero;
use App\Models\Bahia;
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
        $parqueaderos = Parqueadero::with('bahias')->paginate(10);
        return response()->json($parqueaderos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParqueaderoRequest $request)
    {
        $nombre = $request->get('nombre');
        $direccion = $request->get('direccion');
        $nBahias = $request->get('numero_bahias');
        $localizacion = GoogleMaps::calcularLatitudLongitud($direccion);

        $data = [
            'Nombre' => $nombre,
            'Ubicacion' => $direccion,
            'latitud' => $localizacion['latitud'],
            'longitud' => $localizacion['longitud']
        ];

        $parqueadero = Parqueadero::create($data);

        if($nBahias) {
            for($i = 0; $i < $nBahias; $i++) {
                Bahia::create([ 
                    'IdParqueadero' => $parqueadero->id,
                    'Disponible' => true
                ]);
            }
        }

        return response()->json([
            'success' => true, 
            'message' => "Parqueadero registrado exitosamente."
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parqueadero = Parqueadero::with('bahias')->find($id);
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
    public function update(ParqueaderoRequest $request, $id)
    {

        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $nombre = $request->get('nombre');
        $direccion = $request->get('direccion');
        $localizacion = GoogleMaps::calcularLatitudLongitud($direccion);

        $data = [
            'Nombre' => $nombre,
            'Ubicacion' => $direccion,
            'latitud' => $localizacion['latitud'],
            'longitud' => $localizacion['longitud'],
        ];

        $parqueadero->update($data);
        return response()->json([
            'success' => true, 
            'message' => "Parqueadero actualizado exitosamente."
        ]);
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
        return response()->json([ 
            'success' => true, 
            'message' => "Parqueadero eliminado exitosamente." 
        ]);
    }
}
