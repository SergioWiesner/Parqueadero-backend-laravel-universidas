<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = "vehiculos";
    protected $fillable = ['id', 'Placa', 'Marca', 'IdPersona', 'IdTipo', 'created_at', 'updated_at', 'deleted_at'];

    public function persona()
    {
        $this->belongsTo(Persona::class, 'IdPersona', 'id');
    }
}
