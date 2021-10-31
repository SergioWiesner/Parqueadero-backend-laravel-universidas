<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PagoRequest;
use App\Models\Pago;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::paginate(10);
        return response()->json($pagos);
    }

    public function indexByParking($idParqueadero)
    {
        $pagos = Pago::select('pagos.*')->leftJoin('bahias', 'bahias.id', 'pagos.IdBahia')
            ->where(['IdParqueadero' => $idParqueadero ])
            ->paginate(10);
        
        return response()->json($pagos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagoRequest $request)
    {
        $idParqueadero = $request->get('idParqueadero');
        $nPagos = Pago::select('pagos.*')->leftJoin('bahias', 'bahias.id', 'pagos.IdBahia')
            ->where(['IdParqueadero' => $idParqueadero, 'pagos.id' => $id ])->exists();
        
        return response()->json($pago);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pago = Pago::find($id);
        if(!$pago) {
            return response()->json([ 'errors' => [ 'id' => ['id pago doesn\'t exists in this parking'] ]]);
        }
        return response()->json($pago);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagoRequest $request, $id)
    {
        $pago = Pago::find($id);
        if(!$pago) {
            return response()->json([ 'errors' => [ 'id' => ['id pago doesn\'t exists in this parking'] ]]);
        }

        $pago->update([
            'IdBahia' => $request->get('idBahia'),
            'IdVehiculo' => $request->get('idVehiculo'),
            'Tiempo' => $request->get('tiempo'),
            'Costo' => $request->get('costo'),
            'Fecha' => date('Y-m-d h:i:s'),
        ]);

        return response()->json([
            'success' => true, 
            'message' => "Pago actualizado exitosamente."
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
        $pago = Pago::find($id);
        if(!$pago) {
            return response()->json([ 'errors' => [ 'id' => ['id pago doesn\'t exists in this parking'] ]]);
        }

        $pago->delete();
        return response()->json([
            'success' => true, 
            'message' => "Pago eliminado exitosamente."
        ]);

    }
}
