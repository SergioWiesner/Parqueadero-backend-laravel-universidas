<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoRequest;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(array('success' => true, 'message' => Vehiculo::paginate(10)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(VehiculoRequest $request)
    {
        Vehiculo::create([
            'Placa' => $request->Placa,
            'Marca' => $request->Marca,
            'IdPersona' => $request->IdPersona,
            'IdTipo' => $request->IdTipo
        ]);

        return response()->json(array('success' => true, 'message' => "Vehiculo registrado exitosamente."));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(array('success' => true, 'message' => Vehiculo::where('Placa', $id)->get()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return Vehiculo::where('Placa', $id)->update([
            'Marca' => $request->Marca,
            'IdPersona' => $request->IdPersona,
            'IdTipo' => $request->IdTipo
        ]);
        return response()->json(array('success' => true, 'message' => "Vehiculo " . $id . " ah sido actualizado exitosamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Vehiculo::where('Placa', $id)->delete();
        return response()->json(array('success' => true, 'message' => "Vehiculo " . $id . " ah sido eliminado."));
    }
}
