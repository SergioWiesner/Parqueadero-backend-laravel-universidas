<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bahia;
use App\Models\Parqueadero;
use App\Http\Requests\BahiaRequest;

class BahiaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idParqueadero = null)
    {
        if(!$idParqueadero) abort(404);
        $parqueadero = Parqueadero::find($idParqueadero);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $bahias = Parqueadero::find($idParqueadero)->bahias()->paginate(10);
        return response()->json($bahias);
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bahia = Bahia::find($id);
        if(!$bahia) {
            return response()->json([ 'errors' => [ 'id' => ['id bahia doesn\'t exists in this parking'] ]]);
        }
        return response()->json($bahia);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BahiaRequest $request, $idParqueadero = null)
    {
        if(!$idParqueadero) abort(404);
        $parqueadero = Parqueadero::find($idParqueadero);
        if(!$parqueadero) {
            return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
        }

        $disponible = $request->get('disponible');

        $data = [
            'IdParqueadero' => $idParqueadero,
            'Disponible' => $disponible
        ];

        $bahia = Bahia::create($data);
        return response()->json($bahia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BahiaRequest $request, $id)
    {
        try {
            
            $disponible = $request->get('disponible');
            $bahia = Bahia::find($id);
            $bahia->update(['Disponible' => $disponible]);

            return response()->json([
                'success' => true, 
                'message' => "Bahia actualizada exitosamente."
            ]);

        } catch(Exception $e) {
            return response()->json([ 'errors' => [ 'id' => ['id bahia doesn\'t exists'] ]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bahia = Bahia::find($id);
        if(!$bahia) {
            return response()->json([ 'errors' => [ 'id' => ['id bahia doesn\'t exists'] ]]);
        }
        $bahia->delete();
        return response()->json([
            'success' => true, 
            'message' => "Bahia eliminada exitosamente."
        ]);
    }
}
