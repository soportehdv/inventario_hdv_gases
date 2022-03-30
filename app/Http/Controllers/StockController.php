<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Compras;
use App\Models\Clientes;
use Carbon\Carbon;




class StockController extends Controller
{
    public function getStock(Request $request)
    {
        

        if ($request->get('filtro') == null) { //Todas las busquedas
            $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
            ->join('compras', 'compras.id', '=', 'stock.compra_id')
            ->join('estados', 'estados.id', '=', 'stock.estado_id')
            ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
            ->get();
        }  else
                if ($request->get('filtro') == 1) { //Más recientes
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->orderby('stock.created_at', 'asc')                
                    ->get();
        } else
                if ($request->get('filtro') == 2) { // Más antiguos
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->orderby('stock.created_at', 'desc')                
                    ->get();
        } else
                if ($request->get('filtro') == 3) {
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->whereDate('stock.created_at', '=', Carbon::now()->format('Y-m-d'))->get();

        } 
        // else
        //         if ($request->get('filtro') == 4) { //Por fecha
        //             $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
        //             ->join('compras', 'compras.id', '=', 'stock.compra_id')
        //             ->join('estados', 'estados.id', '=', 'stock.estado_id')
        //             ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
        //             ->whereDay('stock.fecha_ingreso', date('d',$fecha_inicio))
        //             ->get();
        // }

        return view('stock/list', [
            'stock' => $stock
        ]);
    }
    public function fechaVista()
    {
        return view('stock/fecha');
    }
}