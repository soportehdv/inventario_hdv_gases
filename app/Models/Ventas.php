<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $table = "ventas";

    protected $fillable = [
        'cliente_id',
        'producto_id',
        'user_id',
    ];
}
