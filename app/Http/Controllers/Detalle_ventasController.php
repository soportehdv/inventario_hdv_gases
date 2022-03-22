<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Detalle_ventas;
use App\Models\Ventas;



class Detalle_ventasController extends Controller
{
    public function getDetalle($venta_id)
    {
        $detalle = Detalle_ventas::where('venta_id', $venta_id)
            ->join('lotes', 'lotes.id', '=', 'detalle_ventas.lote_id')
            ->join('precios_productos', 'precios_productos.id', '=', 'lotes.precio_id')
            ->select('detalle_ventas.id as id', 'lotes.nombre as nombre', 'precios_productos.precio as precio', 'detalle_ventas.unidades as unidades')
            ->get();

        return view('detalle/mostrar', [
            'detalles' => $detalle,
            'venta_id' => $venta_id
        ]);
    }

    public function imprimirFactura($venta_id)
    {
        $detalle = Detalle_ventas::where('venta_id', $venta_id)
            ->join('lotes', 'lotes.id', '=', 'detalle_ventas.lote_id')
            ->join('precios_productos', 'precios_productos.id', '=', 'lotes.precio_id')
            ->select('detalle_ventas.id', 'lotes.nombre', 'precios_productos.precio', 'detalle_ventas.unidades')
            ->get();
        //var_dump('dd');die();

        $venta = Ventas::where('id', $venta_id)->first();
        $pdf = PDF::loadView('factura', [
            'venta' =>  $venta,
            'detalles' => $detalle
        ]);

        return $pdf->download("factura-$venta->created_at.pdf");
    }
}
