<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Precios_productos;



class ProductosController extends Controller
{
    public function getProductos(){
        
        $Productos = Productos::join('proveedores', 'proveedores.id', 'productos.proveedor_id')
                    ->select('productos.id','proveedores.nombre as nombre_proveedor', 'productos.nombre as producto_nombre', 'productos.*')
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
            'proveedor_id'     => 'required',
            
        ]);
        if($validate->fails()){
           return redirect()->back();
        }
        $Productos = new Productos;
        $Productos->nombre = $request->input('name');
        $Productos->proveedor_id = $request->input('proveedor_id');
        $Productos->fecha_vence = $request->input('fecha_vence');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->stock = $request->input('stock');
        $Productos->costo_compra = $request->input('costo_compra');
        $Productos->laboratorio = $request->input('laboratorio');
        $Productos->ubicacion = $request->input('ubicacion');






        $Productos->save();

        //Lógica para guardar precios de los productos
        $i=0;
        $precios = $request->input('precios');
        $titulos = $request->input('titulos');

        foreach($precios as $precio){
            $precio_producto = new Precios_productos();
            $precio_producto->producto_id = $Productos->id;
            $precio_producto->titulo = $titulos[$i++];
            $precio_producto->precio = $precio;
            $precio_producto->unidades =1;
            $precio_producto->save();
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
        $Productos->proveedor_id = $request->input('proveedor_id');
        $Productos->fecha_vence = $request->input('fecha_vence');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->stock = $request->input('stock');
        $Productos->costo_compra = $request->input('costo_compra');
        $Productos->laboratorio = $request->input('laboratorio');
        $Productos->ubicacion = $request->input('ubicacion');


        $Productos->save();

        //Lógica para guardar precios de los productos
        $i=0;
        $precios = $request->input('precios');
        $titulos = $request->input('titulos');

        if($precios){
            foreach($precios as $precio){
                $precio_producto = new Precios_productos();
                $precio_producto->producto_id = $Productos->id;
                $precio_producto->titulo = $titulos[$i++];
                $precio_producto->precio = $precio;
                $precio_producto->unidades = 1;

                $precio_producto->save();
            }
        }
        

        //Lógica para actualizar precios de los productos
        $i=0;
        $precios_viejos = $request->input('precios_viejos');
        $titulos_viejos = $request->input('titulos_viejos');
        $id_viejos = $request->input('id_viejos');

        if($precios_viejos){
            foreach($precios_viejos as $precio_viejo){
                $precio_viejo_detalle = Precios_productos::where('id', $id_viejos[$i])->first();
                $precio_viejo_detalle->titulo = $titulos_viejos[$i++];
                $precio_viejo_detalle->precio = $precio_viejo;

                $precio_viejo_detalle->save();
            }
        }
        



        return redirect()->route('productos.lista');
    }
    

    public function deleteProductos(){
        
    }
}
