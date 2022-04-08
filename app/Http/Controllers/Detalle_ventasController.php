<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalle_ventas;
use App\Models\Ventas;
use PDF;



class Detalle_ventasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }
    public function getDetalle($venta_id)
    {
        $detalle = Detalle_ventas::where('venta_id', $venta_id)
            ->join('productos', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->select('detalle_ventas.id as id', 'productos.serial as nombre')
            ->get();

        return view('detalle/mostrar', [
            'detalles' => $detalle,
            'venta_id' => $venta_id
        ]);
    }

    public function imprimirFactura($venta_id)
    {
        $detalle = Detalle_ventas::where('venta_id', $venta_id)
            ->select('detalle_ventas.id')
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
