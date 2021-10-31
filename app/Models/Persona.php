<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = "personas";
    protected $fillable = ['id', 'tipo_documento', 'documento', 'nombres', 'apellidos', 'direccion', 'telefono', 'firma', 'created_at', 'updated_at', 'deleted_at'];


    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, "IdPersona", "id");
    }
}
