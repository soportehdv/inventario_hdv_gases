<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    protected $fillable = [
        'producto_id',
        'estado_id',
        'fecha_ingreso',
        'fecha_vencimiento',
        'unidades',
        'compra_id'

    ];
}
