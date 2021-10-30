<?php

namespace App\Services;

//Integración con google maps
class GoogleMaps
{
    public static function calcularLatitudLongitud($direccion) {
        //@TODO: Crear API Key google e integrar con google maps para devolver lat y long
        return [
            'latitud' => '4.6903107',
            'longitud' => '-74.1117164'
        ];
    }
}
