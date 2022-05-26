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
use App\Models\Tipo;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;





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
            $query= trim($request->get('search'));
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->join('compras', 'compras.id', '=', 'ventas.producto_id')
                ->select('ventas.id', 'clientes.nombre AS cliente', 'clientes.departamento AS ubicacion', 'users.name AS Vendedor', 'ventas.created_at AS Fecha', 'compras.serial AS serial')
                ->where('serial','LIKE', '%' . $query . '%')
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
        $tipo = Tipo::all();


        return view('Ventas/create', [
            'clientes'  => $clientes,
            'stocks'  => $stocks,
            'compras' => $compras,
            'tipo' => $tipo,

        ]);
    }

    public function createVenta(Request $request)
    {
        $unidades = $request->input('unidades');
        $stock_id = $request->input('stock_id');
        $cliente_id = $request->input('cliente_id');
        $user_id = $request->input('user');        
        // dd($cliente_id);
 
            // enviamos varios datos de ventas
            for ($i=0; $i < count($cliente_id); $i++){
                // dd(count($cliente_id));
                $stock   = Stock::where('id', $stock_id[$i])->first();
                $compras = Compras::where('id', $stock_id[$i])->first();
                // dd($stock->id);

                // condicion si no hay suficientes productos
                if ($unidades[$i] > $stock->unidades) {

                    $request->session()->flash('alert-danger', "No hay suficientes $stock->producto, quedan solo $stock->unidades ");
                    return redirect()->back();
                }
                else
                {
                    $clientes = Clientes::where('id', $cliente_id[$i])->first();
                    $ubicacions = Ubicacion::where('id', $clientes->departamento)->first();

                    $datasave =[
                        'cliente_id'  => $cliente_id[$i],
                        'producto_id' => $stock_id[$i],
                        'user_id'     => $user_id[$i],
                        'created_at'  => Carbon::now()->toDateTimeString(),
                        'updated_at'  => Carbon::now()->toDateTimeString()
                    ];
                // enviamos varios datos al stock
                    $datasave2 =[
                        'unidades'    => $stock->unidades - $unidades[$i],
                        'estado_ubi'  => $ubicacions->nombre,
                        'estado_id'   => 3,
                    ];
                // enviamos varios datos al stock
                    $datasave3 =[
                        'unidades'    => $compras->unidades - $unidades[$i],
                        'estado_ubi'  => $ubicacions->nombre,
                    ];
                // Cambiamos el estado
                    $datasave4 =[
                        // 'estado'    => 'entregado',
                        'entregado' => $clientes->entregado - $unidades[$i] //descontamos de la tabla de entregados
                    ];
                // factura o historial
                    $datasave5 =[
                        'producto_id' => $stock_id[$i],
                        'venta_id'     => $user_id[$i], //usuario quien entrega
                        'created_at'  => Carbon::now()->toDateTimeString(),
                        'updated_at'  => Carbon::now()->toDateTimeString()
                    ];

                // envio a la base de datos
                    DB::table('ventas')->insert($datasave);
                    DB::table('stock')->where('stock.id', $stock_id[$i])->update($datasave2);
                    DB::table('compras')->where('compras.id', $stock_id[$i])->update($datasave3);
                    DB::table('clientes')->where('clientes.id', $cliente_id[$i])->update($datasave4);
                    DB::table('detalle_ventas')->insert($datasave5);

            }
           
        }
        $request->session()->flash('alert-success', 'Entrega realizada con exito!');
        return redirect()->route('ventas.lista', ['filtro' => 4]);           
       
    }

    
    
}
