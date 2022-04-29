<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detalle_ventas;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Proveedores;
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

    public function imprimirFactura(Request $request, $venta_id)
    {
        $proveedor = Proveedores::where('id', $venta_id)->first();

        $detalle = Detalle_ventas::where('venta_id', $venta_id)
            ->select('detalle_ventas.id')
            ->get();
        //var_dump('dd');die();

        $query= trim($proveedor->id);            
            $compras = Compras::join('productos', 'productos.id', '=', 'compras.producto_id')
                ->join('estados', 'estados.id', '=', 'compras.estado_id')
                ->join('proveedores', 'proveedores.id', '=', 'compras.proveedor_id')
                ->select('productos.serial as producto','productos.cod_barra as barras', 'productos.registro as sanitario', 'productos.presentacion as present', 'productos.color as color', 'estados.estado as estado','proveedores.remision as remision', 'compras.*')
                ->where('compras.proveedor_id','LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->get();
                // comentado para pruebas
                // ->paginate(22);

        $venta = Ventas::where('id', $venta_id)->first();

        $pdf = PDF::loadView('factura', [
            'compras' => $compras,
            'venta' =>  $venta,
            'detalles' => $detalle,
            'search' => $query

        ])->setPaper('letter', 'landscape');

        return $pdf->stream("factura-$venta->created_at.pdf");
    }
}
