<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Stock;
use App\Models\Proveedores;
use App\Models\Fracciones;
use App\Models\Productos;






class ComprasController extends Controller
{

    public function getCompras(){
        
        $compras = Compras::join('fracciones', 'fracciones.id', '=', 'compras.fraccion_id')
        ->join('productos', 'productos.id', '=', 'compras.producto_id')
        ->join('proveedores', 'proveedores.id', '=', 'compras.proveedor_id')
        ->select('productos.nombre as producto', 'proveedores.nombre as proveedor', 'fracciones.nombre as fraccion', 'compras.*' )
        ->get();

        return view('compras/lista', [
            'compras' => $compras
        ]);
    }
    public function create(){

        $productos = Productos::all();
        $proveedores = Proveedores::all();
        $fracciones = Fracciones::all();

        return view('Compras/create', [
            'proveedores' => $proveedores,
            'productos' => $productos,
            'fracciones' => $fracciones
        ]);
    }

    public function createCompras(Request $request){

    //validamos los datos

        /*if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }*/


        $Compras = new Compras();
        $Compras->fraccion_id = $request->input('fraccion_id') ;
        $Compras->producto_id =  $request->input('producto_id');
        $Compras->fecha_ingreso = $request->input('fecha_ingreso') ;
        $Compras->precio_compra = $request->input('precio_compra');
        $Compras->costo_unitario = $request->input('costo_unitario');
        $Compras->fecha_vencimiento = $request->input('fecha_vencimiento');
        $Compras->unidades = $request->input('unidades');
        $Compras->nlote = $request->input('nlote');
        $Compras->proveedor_id = $request->input('proveedor_id');

        $Compras->save();

         //Guardamos en el stock
        $stock = new Stock();
        $stock->fraccion_id = $request->input('fraccion_id') ;
        $stock->producto_id =  $request->input('producto_id');
        $stock->fecha_ingreso = $request->input('fecha_ingreso') ;
        $stock->costo_unitario = $request->input('costo_unitario');
        $stock->precio_compra = $request->input('precio_compra');

        $stock->fecha_vencimiento = $request->input('fecha_vencimiento');
        $stock->unidades = $request->input('unidades');
        $stock->compra_id = $Compras->id;

        $stock->save();

        $request->session()->flash('alert-success', 'Compra registrada con exito!');

        return redirect()->route('compras.lista');
    }
}
