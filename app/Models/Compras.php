<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'fraccion_id',
        'producto_id',
        'fecha_ingreso',
        'precio_compra',
        'costo_unitario',
        'fecha_vencimiento',
        'unidades',
        'nlote',
        'proveedor_id',
    ];

}
