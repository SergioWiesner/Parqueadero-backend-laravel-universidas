<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = "tipo_vehiculos";
    protected $fillable = ['id', 'Clase', 'created_at', 'updated_at', 'deleted_at'];

    public function vehiculo()
    {
        return $this->hasMany(Vehiculo::class, 'IdTipo', 'id');
    }

    public function tarifa()
    {
        return $this->hasOne(Tarifa::class, 'IdTipo', 'id');
    }
}
