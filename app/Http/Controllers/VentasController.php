<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Ventas;
use App\Models\Precios_productos;
use App\Models\Lotes;
use App\Models\Productos;
use App\Models\Clientes;


class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function export($filtro = null, $fecha_inicio = null, $fecha_final= null, $id= null){
        return Excel::download(new VentasExport($filtro = null, $fecha_inicio = null, $fecha_final= null, $id= null), 'ventas.xlsx');
    }

    public function imprimirFactura(){
        $pdf = \PDF::loadView('ejemplo');
        return $pdf->download('ejemplo.pdf');
   }

   public function fechaVista(){
       return view('Ventas/fecha');
   }

   public function getVentas(Request $request, $filtro = null, $fecha_inicio = null, $fecha_final= null, $id= null){
        
        if($filtro == null){//Todas
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
            ->join('users', 'users.id', '=', 'ventas.user_id')
            ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
            ->get();
        }else
            if($filtro == 1){//Por cliente
                $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                            ->where('ventas.cliente_id', $id)
                            ->get();
            }else
                if($filtro == 2){//Por fecha
                    $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                    ->join('users', 'users.id', '=', 'ventas.user_id')
                    ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                        ->whereBetween('ventas.created_at', [$fecha_inicio, $fecha_final])
                        ->get();
                }else
                    if($filtro == 3){//Por tipo de cliente
                        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                        ->join('users', 'users.id', '=', 'ventas.user_id')
                        ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                            ->where('clientes.tipo', $id)
                            ->get();
                    }


        return view('Ventas/mostrar', [
            'ventas' => $ventas,
            'filtro' => $filtro,
            'fecha_inicial' => $fecha_inicio,
            'fecha_final' => $fecha_final,
            'id' => $id
        ]);
    }

    public function create(){
        $lotes = Lotes::all();
        $productos = Productos::all();
        $precios = Precios_productos::all();
        $clientes = Clientes::all();

        return view('Ventas/create', [
            'lotes'     => $lotes,
            'productos' => $productos,
            'precios'   => $precios,
            'clientes'  => $clientes
        ]);


    }

    public function createVenta(Request $request){
        var_dump($request->all());die();
    }


}
