<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Bahia;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdBahia',
        'IdVehiculo',
        'Tiempo',
        'Costo',
        'Fecha'
    ];

    public function bahia()
    {
        return $this->belongsTo(Bahia::class, 'IdBahia', 'id');
    }

    public function pagos()
    {
        return $this->belongsTo(Pago::class, 'IdVehiculo', 'id');
    }
}
