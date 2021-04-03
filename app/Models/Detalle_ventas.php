<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_ventas extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'monto',
        'user_id',
        'impuesto',
        
        
    ];
}
