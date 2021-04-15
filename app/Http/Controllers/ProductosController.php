<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Lotes;
use Illuminate\Support\Facades\DB;


use App\Models\Precios_productos;



class ProductosController extends Controller
{

    

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProductos(){

        $Productos = Productos::all();
        

        return view('productos/lista', [
            'productos' => $Productos
        ]);
    }

    public function sinStock(){
        
        $Productos = Productos::join('lotes', 'producto_id','=','productos.id')
        ->groupBy('lotes.producto_id')
        ->select('productos.id','productos.nombre', DB::raw('SUM(lotes.unidades) AS cantidad'))
        ->having(DB::raw('SUM(lotes.unidades) = 0'))
        ->get();

        return view('productos/lista', [
            'productos' => $Productos
        ]);
    }

    public function getProductosStock(){
        
        $Productos = Productos::join('lotes', 'producto_id','=','productos.id')
        ->groupBy('lotes.producto_id')
        ->select('productos.id','productos.nombre', DB::raw('SUM(lotes.unidades) AS cantidad'))
        ->get();

        return view('productos/lista', [
            'productos' => $Productos
        ]);
    }

    public function create(){
        $proveedores = Proveedores::all();

        return view('productos/create',[
            'proveedores' =>  $proveedores,
            'precios'     => null
        ]);
    }

    public function createProductos(Request $request){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            
        ]);
        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar producto');

           return redirect()->back();
        }
        $Productos = new Productos();
        $Productos->nombre = $request->input('name');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->ubicacion = $request->input('ubicacion');
        $Productos->registro = $request->input('registro');
        $Productos->componente = $request->input('componente');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->save();

        

        
        $request->session()->flash('alert-success', 'Producto registrado con exito!');

        return redirect()->route('productos.lista');
    }

    public function update($id){
        
        $Productos = Productos::where('id', $id)->first();
       

        return view('productos/create', [
            'producto' => $Productos,
            
        ]);

    }

    public function updateProductos(Request $request, $Productos_id){

        $Productos = Productos::where('id', $Productos_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
           
        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar productos');

            return redirect()->back();
        }
        $Productos->nombre = $request->input('name');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->ubicacion = $request->input('ubicacion');
        $Productos->registro = $request->input('registro');
        $Productos->componente = $request->input('componente');
        $Productos->cod_barra = $request->input('cod_barra');
        
        $Productos->save();

        $request->session()->flash('alert-success', 'Producto actualizado con exito!');


        return redirect()->route('productos.lista');
    }
    

    public function deleteProductos(){
        
    }
}
