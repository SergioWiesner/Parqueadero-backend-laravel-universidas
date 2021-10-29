<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVehiculoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_vehiculos')->insert([
            'Clase' => "Publico"
        ]);
        DB::table('tipo_vehiculos')->insert([
            'Clase' => "Privado"
        ]);
    }
}
