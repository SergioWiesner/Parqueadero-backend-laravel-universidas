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
    public function index($idParqueadero)
    {
        $bahias = Parqueadero::find($idParqueadero)->bahias()->paginate(10);
        return response()->json($bahias);
    }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idParqueadero, $id)
    {
        $bahia = Parqueadero::find($idParqueadero)->bahias->find($id);     
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
    public function store(BahiaRequest $request, $idParqueadero)
    {
        $disponible = $request->get('disponible');

        $data = [
            'IdParqueadero' => $idParqueadero,
            'Disponible' => $disponible
        ];

        $bahia = Bahia::create($data);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BahiaRequest $request, $idParqueadero, $id)
    {
        try {
            
            $disponible = $request->get('disponible');
            $bahia = Parqueadero::find($idParqueadero)->bahias->find($id);
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
    public function destroy($idParqueadero, $id)
    {
        $bahia = Parqueadero::find($idParqueadero)->bahias->find($id);
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
