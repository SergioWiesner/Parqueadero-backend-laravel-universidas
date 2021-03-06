<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;

    protected $table = "tarifas";
    protected $fillable = ['id', 'Costo', 'IdTipo', 'created_at', 'updated_at'];

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'IdTipo', 'id');
    }
}
