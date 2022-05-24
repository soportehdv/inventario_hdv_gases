<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = "stock";

    protected $fillable = [
        'estado_id',
        'fecha_vencimiento',
        'unidades',
        'uni',
        'compra_id',
        'tipo',

        'status',


    ];
}
