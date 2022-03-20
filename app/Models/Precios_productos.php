<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios_productos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'precio',
        'unidades',
        'tipo',
    ];
}
