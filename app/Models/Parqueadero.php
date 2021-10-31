<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bahia;

class Parqueadero extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nombre',
        'Ubicacion',
        'latitud',
        'longitud'
    ];

    public function bahias()
    {
        return $this->hasMany(Bahia::class, "IdParqueadero", "id");
    }

}
