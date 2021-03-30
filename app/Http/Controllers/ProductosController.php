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
           return redirect()->back();
        }
        $Productos = new Productos();
        $Productos->nombre = $request->input('name');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->save();

        //Lógica para guardar precios de los productos
        $i=0;
        $precios = $request->input('precios');
        $titulos = $request->input('titulos');
        $tipos = $request->input('tipos');
        $unidades = $request->input('unidades');

        foreach($precios as $precio){
            $precio_producto = new Precios_productos();
            $precio_producto->producto_id = $Productos->id;
            $precio_producto->titulo = $titulos[$i];
            $precio_producto->precio = $precio;
            $precio_producto->tipo = $tipos[$i];
            $precio_producto->unidades =$unidades[$i];
            $precio_producto->save();
            $i++;
        }

        

        return redirect()->route('productos.lista');
    }

    public function update($id){
        
        $Productos = Productos::where('id', $id)->first();
        $precios = Precios_productos::where('producto_id', $id)->get();
        $proveedores = Proveedores::all();

        return view('productos/create', [
            'producto' => $Productos,
            'precios'   => $precios,
            'proveedores' => $proveedores
        ]);

    }

    public function updateProductos(Request $request, $Productos_id){

        $Productos = Productos::where('id', $Productos_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
           
        ]);

        if($validate->fails()){
            return redirect()->back();
        }
        $Productos->nombre = $request->input('name');
       
        $Productos->cod_barra = $request->input('cod_barra');
        


        $Productos->save();

        //Lógica para guardar precios de los productos
        $i=0;
        $precios = $request->input('precios');
        $titulos = $request->input('titulos');
        $tipos = $request->input('tipos');
        $unidades = $request->input('unidades');

        if($precios){
            foreach($precios as $precio){
                $precio_producto = new Precios_productos();
                $precio_producto->producto_id = $Productos->id;
                $precio_producto->titulo = $titulos[$i];
                $precio_producto->precio = $precio;
                $precio_producto->tipo = $tipos[$i];
                $precio_producto->unidades =$unidades[$i];

                $precio_producto->save();
                $i++;
            }
        }
        

        //Lógica para actualizar precios de los productos
        $i=0;
        $precios_viejos = $request->input('precios_viejos');
        $titulos_viejos = $request->input('titulos_viejos');
        $id_viejos = $request->input('id_viejos');
        $tipos_viejos = $request->input('tipos_viejos');
        $unidades_viejos = $request->input('unidades_viejos');

        if($precios_viejos){
            foreach($precios_viejos as $precio_viejo){
                $precio_producto =Precios_productos::where('id', $id_viejos[$i])->first();;
                $precio_producto->producto_id = $Productos->id;
                $precio_producto->titulo = $titulos_viejos[$i];
                $precio_producto->precio = $precio_viejo;
                $precio_producto->tipo = $tipos_viejos[$i];
                $precio_producto->unidades =$unidades_viejos[$i];
                $precio_producto->save();
                $i++;
            }
        }
        



        return redirect()->route('productos.lista');
    }
    

    public function deleteProductos(){
        
    }
}
