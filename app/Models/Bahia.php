<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Pago;

class Bahia extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdParqueadero',
        'Disponible'
    ];

    public function parqueadero()
    {
        $this->belongsTo(Parqueadero::class, 'IdParqueadero', 'id');
    }

    public function pagos()
    {
        $this->hasMany(Pago::class, 'IdBahia', 'id');
    }
}
