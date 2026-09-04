<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'mueble_id',
        'cliente',
        'cantidad',
        'fecha_venta',
        'total',
    ];

    public function mueble()
    {
        return $this->belongsTo(Mueble::class);
    }
}