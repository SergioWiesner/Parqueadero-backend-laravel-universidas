<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Parqueadero;

class ParkingExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $idParqueadero = $request->route()->parameter('parqueadero');
        if($idParqueadero) {
            $parqueadero = Parqueadero::find($idParqueadero);
            if(!$parqueadero) {
                return response()->json([ 'errors' => [ 'id' => ['id parking doesn\'t exists'] ]]);
            }
        }
        
        return $next($request);
    }
}
