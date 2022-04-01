<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Compras;
use App\Models\Clientes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;





class StockController extends Controller
{
    public function getStock(Request $request)
    {
        

        if ($request->get('filtro') == null) { //Todas las busquedas
            $query= trim($request->get('search'));            
            $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
            ->join('compras', 'compras.id', '=', 'stock.compra_id')
            ->join('estados', 'estados.id', '=', 'stock.estado_id')
            ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
            ->where('productos.serial','LIKE', '%' . $query . '%')
            ->get();

            return view('stock/list', [
                'stock' => $stock,
                'search' => $query
            ]);
        }  else
                if ($request->get('filtro') == 1) { //Más recientes
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->orderby('stock.created_at', 'asc')                
                    ->get();

                    return view('stock/list', [
                        'stock' => $stock
                    ]);
        } else
                if ($request->get('filtro') == 2) { // Más antiguos
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->orderby('stock.created_at', 'desc')                
                    ->get();

                    return view('stock/list', [
                        'stock' => $stock
                    ]);
        } else
                if ($request->get('filtro') == 3) { //Hoy
                    $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
                    ->join('compras', 'compras.id', '=', 'stock.compra_id')
                    ->join('estados', 'estados.id', '=', 'stock.estado_id')
                    ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
                    ->whereDate('stock.created_at', '=', Carbon::now()->format('Y-m-d'))->get();
                    
                    return view('stock/list', [
                        'stock' => $stock
                    ]);
        } 
        // return view('stock/list', [
        //     'stock' => $stock
        // ]);
    }
    public function fechaVista(Request $request){
        $start = Carbon::parse($request->get('fecha_inicial'));
        $end = Carbon::parse($request->get('fecha_final'));
        $stock = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
        ->join('compras', 'compras.id', '=', 'stock.compra_id')
        ->join('estados', 'estados.id', '=', 'stock.estado_id')
        ->select('stock.*','productos.serial as producto', 'compras.lote as lote', 'estados.estado as estados')
        ->whereDate('stock.fecha_ingreso','<=',$end)
        ->whereDate('stock.fecha_ingreso','>=',$start)
        ->get();

        return view('stock/list', [
            'stock' => $stock
        ]);
    }
}