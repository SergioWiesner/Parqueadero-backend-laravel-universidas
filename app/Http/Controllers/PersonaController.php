<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::get();
        return response()->json($personas);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $registro = Persona::where("documento", $request->documento)->first();
            if (!is_null($registro) && count($registro) > 0) {
                Persona::where("documento", $request->documento)->update([
                    'tipo_documento' => $request->tipo_documento,
                    'nombres' => $request->nombres,
                    'apellidos' => $request->apellidos,
                    'direccion' => $request->direccion,
                    'telefono' => $request->telefono,
                    'firma' => $request->firma
                ]);
                return response()->json(array('success' => true, 'message' => "Usuario " . $request->nombres . " ah sido actualizado."));
            }

            Persona::create([
                'tipo_documento' => $request->tipo_documento,
                "documento" => $request->documento,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'firma' => $request->firma
            ]);
            return response()->json(array('success' => true, 'message' => "Usuario " . $request->nombres . " ah sido creado exitosamente."));
        } catch (\Exception $e) {
            return response()->json(array('success' => false, 'message' => "Error al crear o actualizar el usuario " . $request->nombres));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
