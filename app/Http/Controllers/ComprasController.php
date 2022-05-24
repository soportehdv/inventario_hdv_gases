<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Stock;
use App\Models\Proveedores;
use App\Models\Fracciones;
use App\Models\Ubicacion;
use App\Models\Estados;
use App\Models\Tipo;
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
            $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
                ->join('tipos', 'tipos.id', '=', 'compras.tipo')
                ->join('proveedores', 'proveedores.id', '=', 'compras.proveedor_id')
                ->select(  'estados.estado as estado','proveedores.remision as remision', 'tipos.nombre as tipos', 'compras.*')
                ->where('serial','LIKE', '%' . $query . '%')
                ->where('status','LIKE', '%' . 1 . '%')
                ->orderBy('id', 'asc')
                // ->get();
                // comentado para pruebas
                ->paginate(10);

            return view('compras/lista', [
                'compras' => $compras,
                'search' => $query
            ]);
        }
    }
    public function create()
    {
        $estado = Estados::all();
        $proveedores = Proveedores::all();
        $Ubicacion = Ubicacion::all();
        $tipo = Tipo::all();

        

        return view('Compras/create', [
            'estado' => $estado,
            'proveedores' => $proveedores,
            'ubicacion' => $Ubicacion,
            'tipo' => $tipo,

        ]);
    }

    public function createCompras(Request $request)
    {
        // dd($request->all());

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'unidades'      => 'required',
            'serial'      => 'required',
            'presentacion'      => 'required',
            'registro'      => 'required',
            'color'      => 'required',

        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error en el almacenando los datos');

            return redirect()->back();
        }
        

        $Compras = new Compras();

        $Compras->serial = $request->input('serial');
        $Compras->presentacion = $request->input('presentacion');
        $Compras->registro = $request->input('registro');
        $Compras->color = $request->input('color');

        
        $Compras->estado_id =  $request->input('estado_id');
        $Compras->proveedor_id =  $request->input('proveedor_id');
        $Compras->tipo =  $request->input('tipo');
        $Compras->fecha_vencimiento = $request->input('fecha_vencimiento');
        $Compras->unidades = $request->input('unidades');
        $Compras->uni = $request->input('unidades');
        $Compras->lote = $request->input('lote');
        $Compras->limpieza = $request->input('limpieza');
        $Compras->sello = $request->input('sello');
        $Compras->eti_producto = $request->input('eti_producto');
        $Compras->prueba = $request->input('prueba');
        $Compras->estandar = $request->input('estandar');
        $Compras->eti_lote = $request->input('eti_lote');
        $Compras->integridad = $request->input('integridad');

        $Compras->status = 1;

        if ($Compras->limpieza == "C" && $Compras->sello == "C" && $Compras->eti_producto == "C" && $Compras->prueba == "C" && $Compras->estandar == "C" && $Compras->eti_lote == "C" && $Compras->integridad == "C"){
            $Compras->aprobado = "X";
        }else{
            $Compras->rechazado = "X";
        }


        $Compras->save();

        //Guardamos en el stock

        $stock = new Stock();
        $stock->estado_id =  $request->input('estado_id');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->unidades = $request->input('unidades');     
        $stock->uni = $request->input('unidades');     
        $stock->tipo =  $request->input('tipo');
        $stock->compra_id = $Compras->id;

        $Compras->status = 1;

        $stock->save();

        
        $proveedores = Proveedores::where('id', $request->input('proveedor_id'))->first();
        $proveedores->contador = $request->input('contador') + 1;
        $proveedores->save();

        $request->session()->flash('alert-success', 'Producto registrado con exito!');

        return redirect()->route('compras.lista');
    }
    public function update($id)
    {
        $compras = Compras::where('id', $id)->first();
        $estado = Estados::all();
        $proveedores = Proveedores::all();

        // $fracciones = Fracciones::all();

        return view('Compras/editar', [
            'compras' => $compras,
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
            $request->session()->flash('alert-danger', 'Error al actualizar producto');

            return redirect()->back();
        }

        //validamos los datos
        // $Compras = new Compras();
        $Compras->serial = $request->input('serial');
        $Compras->presentacion = $request->input('presentacion');
        $Compras->registro = $request->input('registro');
        $Compras->color = $request->input('color');

        $Compras->estado_id =  $request->input('estado_id');
        $Compras->proveedor_id =  $request->input('proveedor_id');
        $Compras->fecha_vencimiento = $request->input('fecha_vencimiento');
        $Compras->unidades = $request->input('unidades');
        $Compras->uni = $request->input('unidades');
        $Compras->lote = $request->input('lote');
        $Compras->limpieza = $request->input('limpieza');
        $Compras->sello = $request->input('sello');
        $Compras->eti_producto = $request->input('eti_producto');
        $Compras->prueba = $request->input('prueba');
        $Compras->estandar = $request->input('estandar');
        $Compras->eti_lote = $request->input('eti_lote');
        $Compras->integridad = $request->input('integridad');


        $Compras->save();


        //Guardamos en el stock

        $stock->estado_id =  $request->input('estado_id');
        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->unidades = $request->input('unidades');
        $stock->uni = $request->input('unidades');
        $stock->tipo =  $request->input('tipo');
        $stock->compra_id = $Compras->id;

        $stock->save();

        $request->session()->flash('alert-success', 'Ingreso actualizado con exito!');

        return redirect()->route('compras.lista');
    }
    public function updateProducto($id)
    {
        $compras = Compras::where('id', $id)->first();
        $estado = Estados::all();
        $proveedores = Proveedores::all();
        $ubicacion = Ubicacion::all();

        // $fracciones = Fracciones::all();

        return view('Compras/editarProducto', [
            'compras' => $compras,
            'estado' => $estado,
            'proveedores' => $proveedores,
            'ubicacion' => $ubicacion,


            // 'fracciones' => $fracciones
        ]);
    }
    public function updatecomprasProducto(Request $request, $compra_id)
    {

        $Compras = Compras::where('id', $compra_id)->first();
        $stock = Stock::where('id', $compra_id)->first();


        $validate = Validator::make($request->all(), [
            'estado_id'      => 'required',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al devolver producto');

            return redirect()->back();
        }

        //validamos los datos
        
        $Compras->estado_id =  $request->input('estado_id');
        $Compras->estado_ubi =  $request->input('ubicacion');
        $Compras->unidades =  $Compras->unidades + 1;
        $Compras->save();


        //Guardamos en el stock

        $stock->estado_id =  $request->input('estado_id');
        $stock->estado_ubi =  $request->input('ubicacion');
        $stock->unidades =  $stock->unidades + 1;
        $stock->save();

        $request->session()->flash('alert-success', 'Devolución con exito!');

        return redirect()->route('devolucion.list');
    }
    public function updatecomprasCar($id){
        $compras = Compras::where('id', $id)->first();
        $stock   = Stock  ::where('id', $id)->first();

        //validamos los datos
        
        $compras->status =  0;
        $compras->save();


        //Guardamos en el stock

        $stock->status =  0;
        $stock->save();

        return redirect()->back();


    }
}
