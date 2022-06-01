<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'registro',


        'estado_id',
        'estado_ubi',
        'proveerdor_id',
        'tipo',
        'fecha_vencimiento',
        'unidades',
        'uni',
        'lote',
        'limpieza',
        'sello',
        'eti_producto',
        'prueba',
        'estandar',
        'eti_lote',
        'integridad',
        'aprobado',
        'rechazado',

        'status',


        // 'costo_unitario',
        // 'precio_compra',
        // 'fraccion_id',
    ];

}
