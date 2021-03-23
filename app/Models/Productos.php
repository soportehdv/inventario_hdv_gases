<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'proveedor_id',
        'laboratorio',
        'stock',
        'fecha_vence',
        'costo_compra',
        'ubicacion',
        'cod_barra'
        
    ];
}
