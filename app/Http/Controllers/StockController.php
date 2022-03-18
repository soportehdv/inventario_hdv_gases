<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Compras;



class StockController extends Controller
{
    public function getStock()
    {
        $stock = Stock::join('fracciones', 'fracciones.id', '=', 'stock.fraccion_id')
            ->join('productos', 'productos.id', '=', 'stock.producto_id')
            ->join('compras', 'compras.id', '=', 'stock.compra_id')
            ->select('stock.*','productos.nombre as producto', 'fracciones.nombre as fraccion', 'compras.nlote as lote')
            ->get();

        return view('stock/list', [
            'stock' => $stock
        ]);
    }
}
