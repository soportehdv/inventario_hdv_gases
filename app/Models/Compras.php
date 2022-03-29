<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'remision',
        'producto_id',
        'estado_id',
        'fecha_ingreso',
        'fecha_vencimiento',
        'unidades',
        'lote',
        'limpieza',
        'sello',
        'eti_producto',
        'prueba',
        'estandar',
        'eti_lote',
        'integridad'

        // 'costo_unitario',
        // 'precio_compra',
        // 'fraccion_id',
    ];

}
