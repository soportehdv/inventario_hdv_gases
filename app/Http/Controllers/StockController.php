<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function getStock(){
        $stock =  Compras::join('fracciones', 'fracciones.id', '=', 'stock.fraccion_id')
        ->join('productos', 'productos.id', '=', 'stock.producto_id')
        ->select('productos.nombre AS producto', 'fracciones.nombre as fraccion', 'stock.*' )
        ->get();
        
        return view('Stock/lista', [
            'stocks' => $stock
        ]);
    }
}
