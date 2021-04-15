<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table="stock";

    protected $fillable = [
        'fraccion_id',
        'producto_id',
        'fecha_ingreso',
        'precio_compra',
        'fecha_vencimiento',
        'unidades',
        'compra_id'
        
    ];

    
}
