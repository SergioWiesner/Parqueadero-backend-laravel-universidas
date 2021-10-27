<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ParqueaderoRequest;
use App\Models\Parqueadero;
use App\Services\GoogleMaps;

class ParqueaderoController extends Controller
{

    public function list()
    {
        $parqueaderos = Parqueadero::get();
        return response()->json($parqueaderos);
    }

    public function get($id)
    {
        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }
        
        return response()->json($parqueadero);
    }

    public function create(ParqueaderoRequest $request)
    {
        $request->validated();

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

    public function update(ParqueaderoRequest $request, $id)
    {
        $request->validated();

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

    public function delete($id)
    {

        $parqueadero = Parqueadero::find($id);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $parqueadero->delete();
        return response()->json([ 'deleted' => true ]);
    }
}
