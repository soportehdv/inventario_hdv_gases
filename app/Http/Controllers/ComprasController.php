<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Stock;
use App\Models\Proveedores;
use App\Models\Fracciones;
use App\Models\Productos;
use App\Models\Ubicacion;
use App\Models\Estados;
use Illuminate\Support\Facades\Validator;







class ComprasController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');
    
        }

    public function getCompras(Request $request)
    {
        if($request){

            $query= trim($request->get('search'));            
            $compras = Compras::join('productos', 'productos.id', '=', 'compras.producto_id')
                ->join('estados', 'estados.id', '=', 'compras.estado_id')
                ->join('proveedores', 'proveedores.id', '=', 'compras.proveedor_id')
                ->select('productos.serial as producto','productos.cod_barra as barras', 'productos.registro as sanitario', 'productos.presentacion as present', 'productos.color as color', 'estados.estado as estado','proveedores.remision as remision', 'compras.*')
                ->where('productos.cod_barra','LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->get();
                // comentado para pruebas
                // ->paginate(10);

            return view('compras/lista', [
                'compras' => $compras,
                'search' => $query
            ]);
        }
    }
    public function create()
    {
        $estado = Estados::all();
        $productos = Productos::all();
        $proveedores = Proveedores::all();
        $Ubicacion = Ubicacion::all();

        return view('Compras/create', [
            'estado' => $estado,
            'productos' => $productos,
            'proveedores' => $proveedores,
            'ubicacion' => $Ubicacion
        ]);
    }

    public function createCompras(Request $request)
    {
        // dd($request->all());

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'unidades'      => 'required',

        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error en el almacenando los datos');

            return redirect()->back();
        }
        

        $Compras = new Compras();
        $Compras->producto_id =  $request->input('producto_id');
        $Compras->estado_id =  $request->input('estado_id');
        $Compras->proveedor_id =  $request->input('proveedor_id');
        $Compras->fecha_ingreso = $request->input('fecha_ingreso');
        $Compras->fecha_vencimiento = $request->input('fecha_vencimiento');
        $Compras->unidades = $request->input('unidades');
        $Compras->lote = $request->input('lote');
        $Compras->limpieza = $request->input('limpieza');
        $Compras->sello = $request->input('sello');
        $Compras->eti_producto = $request->input('eti_producto');
        $Compras->prueba = $request->input('prueba');
        $Compras->estandar = $request->input('estandar');
        $Compras->eti_lote = $request->input('eti_lote');
        $Compras->integridad = $request->input('integridad');
        // $Compras->precio_compra = $request->input('precio_compra');
        // $Compras->costo_unitario = $request->input('costo_unitario');
        // $Compras->nlote = $request->input('nlote');
        // $Compras->fraccion_id = $request->input('fraccion_id');

        $Compras->save();

        //Guardamos en el stock
        $stock = new Stock();
        $stock->producto_id =  $request->input('producto_id');
        $stock->estado_id =  $request->input('estado_id');
        $stock->fecha_ingreso = $request->input('fecha_ingreso');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->unidades = $request->input('unidades');
        
        $stock->compra_id = $Compras->id;
        // $stock->costo_unitario = $request->input('costo_unitario');
        // $stock->fraccion_id = $request->input('fraccion_id');

        $stock->save();

        $request->session()->flash('alert-success', 'Compra registrada con exito!');

        return redirect()->route('compras.lista');
    }
    public function update($id)
    {
        $compras = Compras::where('id', $id)->first();
        $productos = Productos::all();
        $estado = Estados::all();
        $proveedores = Proveedores::all();

        // $fracciones = Fracciones::all();

        return view('Compras/editar', [
            'compras' => $compras,
            'productos' => $productos,
            'estado' => $estado,
            'proveedores' => $proveedores,

            // 'fracciones' => $fracciones
        ]);
    }
    public function updatecompras(Request $request, $compra_id)
    {

        $Compras = Compras::where('id', $compra_id)->first();
        $stock = Stock::where('id', $compra_id)->first();


        $validate = Validator::make($request->all(), [
            'unidades'      => 'required',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar usuario');

            return redirect()->back();
        }

        //validamos los datos
        // $Compras = new Compras();
        $Compras->producto_id =  $request->input('producto_id');
        $Compras->estado_id =  $request->input('estado_id');
        $Compras->proveedor_id =  $request->input('proveedor_id');
        $Compras->fecha_ingreso = $request->input('fecha_ingreso');
        $Compras->fecha_vencimiento = $request->input('fecha_vencimiento');
        $Compras->unidades = $request->input('unidades');
        $Compras->lote = $request->input('lote');
        $Compras->limpieza = $request->input('limpieza');
        $Compras->sello = $request->input('sello');
        $Compras->eti_producto = $request->input('eti_producto');
        $Compras->prueba = $request->input('prueba');
        $Compras->estandar = $request->input('estandar');
        $Compras->eti_lote = $request->input('eti_lote');
        $Compras->integridad = $request->input('integridad');

        // $Compras->nlote = $request->input('nlote');
        // $Compras->precio_compra = $request->input('precio_compra');
        // $Compras->fraccion_id = $request->input('fraccion_id');

        $Compras->save();

        // $stock = Stock::where('id', $compra_id)->first();

        //Guardamos en el stock
        // $stock = new Stock();
        $stock->producto_id =  $request->input('producto_id');
        $stock->estado_id =  $request->input('estado_id');
        $stock->fecha_ingreso = $request->input('fecha_ingreso');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->unidades = $request->input('unidades');
        $stock->compra_id = $Compras->id;
        // $stock->precio_compra = $request->input('precio_compra');
        // $stock->fraccion_id = $request->input('fraccion_id');

        $stock->save();

        $request->session()->flash('alert-success', 'Ingreso actualizado con exito!');

        return redirect()->route('compras.lista');
    }
 
}
