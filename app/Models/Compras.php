<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'presentacion',
        'registro',
        'color',

        
        'estado_id',
        'estado_ubi',
        'proveerdor_id',
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
