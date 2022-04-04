<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\VentasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Ventas;
use App\Models\Stock;
use App\Models\Precios_productos;
use App\Models\Lotes;
use App\Models\User;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\Detalle_ventas;
use PDF;
use Carbon\Carbon;
use App\Models\Compras;





class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function export($filtro = null, $fecha_inicio = null, $fecha_final = null, $id = null)
    {
        return Excel::download(new VentasExport($filtro = null, $fecha_inicio = null, $fecha_final = null, $id = null), 'ventas.xlsx');
    }

    public function imprimirFactura()
    {
        $pdf = PDF::loadView('ejemplo');
        return $pdf->download('ejemplo.pdf');
    }

   
    public function getVentas(Request $request)
    {

        if ($request->get('filtro') == null) { //Todas
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                ->get();
        } else
            if ($request->get('filtro') == 1) { //Más recientes
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                ->orderby('ventas.created_at', 'asc')
                ->get();
        } else
                if ($request->get('filtro') == 2) { // Más antiguos
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                ->orderby('ventas.created_at', 'desc')
                ->get();
        } else
                if ($request->get('filtro') == 3) {
            $ventas = Ventas::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
        }


        return view('Ventas/mostrar', [
            'ventas' => $ventas,
            
        ]);
    }
    public function fechaVista(Request $request){
        $start = Carbon::parse($request->get('fecha_inicial'));
        $end = Carbon::parse($request->get('fecha_final'));
        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
        ->join('users', 'users.id', '=', 'ventas.user_id')
        ->select('ventas.id', 'clientes.nombre AS cliente', 'ventas.monto', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
        ->whereDate('ventas.created_at','<=',$end)
        ->whereDate('ventas.created_at','>=',$start)
        ->get();

        return view('Ventas/mostrar', [
            'ventas' => $ventas,
            
        ]);
    }

    public function create()
    {
        

        $stocks = Stock::join('productos', 'productos.id', '=', 'stock.producto_id')
            ->select('stock.*', 'productos.serial as producto')
            ->get();
              
        $clientes = Clientes::all();
        $productos = Productos::all();

        return view('Ventas/create', [
            'clientes'  => $clientes,
            'stocks'  => $stocks,
            'productos' => $productos,

        ]);
    }

    public function createVenta(Request $request)
    {

        $unidades = $request->input('unidades');
        $stock_id = $request->input('stock_id');

        $venta = new Ventas();
        $venta->cliente_id = $request->input('cliente_id');
        $venta->monto = 0;
        $venta->impuesto = 0.13;
        $venta->descuento = 0;
        $venta->user_id = Auth::user()->id;
        $venta->save(); //se crea la venta

        $i = 0;
        $monto_final = 0;

        

        $stock = Stock::where('stock.id', $stock_id)
            ->join('productos', 'productos.id', '=', 'stock.producto_id')
            ->select('stock.*', 'productos.serial as producto')
            ->first();
        $compras = Compras::all()->first();


        
        if ($unidades > $stock->unidades && $unidades > $compras->unidades) {

            $request->session()->flash('alert-danger', "No hay suficientes $stock->producto, quedan solo $stock->unidades ");
            return redirect()->back();
        }

        $stock->unidades = $stock->unidades - $unidades;
        $stock->save();
        $compras->unidades = $compras->unidades - $unidades;
        $compras->save();

        // ---------------------factura o historial

        $detalle = new Detalle_ventas();
        $detalle->producto_id = $stock->producto_id;
        $detalle->venta_id = $venta->id; //usuario quien entrego

        $detalle->unidades = $unidades;
        $detalle->save();

        $monto_final += 20 * $unidades;

            


        $monto_impuesto = $monto_final * 0.13;
        $monto_final = $monto_final + $monto_impuesto;

        $venta->monto = $monto_final;
        $venta->save();

        $request->session()->flash('alert-success', 'Venta realizada con exito!');
        return redirect()->route('ventas.lista', ['filtro' => 4]);
    }

    
    
}
