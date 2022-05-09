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
use App\Models\Clientes;
use App\Models\Detalle_ventas;
use App\Models\Compras;
use App\Models\Ubicacion;
use PDF;
use Carbon\Carbon;





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
            $ubicacion = Ubicacion::all();
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->join('compras', 'compras.id', '=', 'ventas.producto_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'clientes.departamento AS ubicacion', 'users.name AS Vendedor', 'ventas.created_at AS Fecha', 'compras.serial AS serial')
                ->orderby('ventas.created_at', 'desc')
                ->simplePaginate(10);
            
            

                return view('Ventas/mostrar', [
                    'ubicacion' => $ubicacion,
                    'ventas' => $ventas,
                    
                ]);
        } 


        
    }
    public function fechaVista(Request $request){
        $start = Carbon::parse($request->get('fecha_inicial'));
        $end = Carbon::parse($request->get('fecha_final'));
        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
        ->join('users', 'users.id', '=', 'ventas.user_id')
        ->select('ventas.id', 'clientes.nombre AS cliente', 'users.name AS Vendedor', 'ventas.created_at AS Fecha')
        ->whereDate('ventas.created_at','<=',$end)
        ->whereDate('ventas.created_at','>=',$start)
        // ->get();
        ->paginate(50);

        return view('Ventas/mostrar', [
            'ventas' => $ventas,
            
        ]);
    }

    public function create()
    {
        

        $stocks = Stock::join('compras', 'compras.id', '=', 'stock.compra_id')
            ->select('stock.*', 'compras.serial as producto')
            ->get();
              
        $clientes = Clientes::all();
        $compras = Compras::all();

        return view('Ventas/create', [
            'clientes'  => $clientes,
            'stocks'  => $stocks,
            'compras' => $compras,

        ]);
    }

    public function createVenta(Request $request)
    {

        $unidades = $request->input('unidades');
        $stock_id = $request->input('stock_id');
        $cliente_id = $request->input('cliente_id');


        $venta = new Ventas();
        $venta->cliente_id = $request->input('cliente_id');
        $venta->producto_id = $request->input('stock_id');
        $venta->user_id = Auth::user()->id;

        

        $stock = Stock::where('stock.id', $stock_id)
            ->join('compras', 'compras.id', '=', 'stock.compra_id')
            ->select('stock.*', 'compras.serial as producto')
            ->first();
        $compras = Compras::all()->first();


        // condicion si no hay suficientes productos
        if ($unidades > $stock->unidades && $unidades > $compras->unidades) {

            $request->session()->flash('alert-danger', "No hay suficientes $stock->producto, quedan solo $stock->unidades ");
            return redirect()->back();
        }
        else
        {
            $venta->save(); //se crea la venta

            // actualizacion de estado en la tabla clientes
            $clientes = Clientes::where('id', $cliente_id)->first();
            $ubicacions = Ubicacion::where('id', $clientes->departamento)->first();
            

            //---------------------Descontamos del stock total 
            $stock->unidades = $stock->unidades - $unidades;
            $stock->estado_ubi = $ubicacions->nombre;
            $stock->estado_id = 3;
            $stock->save();

            //---------------------Descontamos del total ingresado 
            $compras->unidades = $compras->unidades - $unidades;
            $compras->estado_ubi = $ubicacions->nombre;
            $compras->save();
            // dd($ubicacions->id);

            
            $clientes->estado='entregado';
            $clientes->save();

            // ---------------------factura o historial

            $detalle = new Detalle_ventas();
            $detalle->producto_id = $stock->compra_id;
            $detalle->venta_id = $venta->id; //usuario quien entrego

            $detalle->save();



            $request->session()->flash('alert-success', 'Venta realizada con exito!');
            return redirect()->route('ventas.lista', ['filtro' => 4]);
            }
        
       
    }

    
    
}
