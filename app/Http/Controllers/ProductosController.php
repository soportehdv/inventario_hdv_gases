<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Lotes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



use App\Models\Precios_productos;



class ProductosController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');

    }

    public function getProductos(Request $request)
    {
        if($request){

            $query= trim($request->get('search'));
            $Productos = Productos::where('serial','LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->get();

            return view('productos/lista', [
                'productos' => $Productos,
                'search' => $query
            ]);

        }

        // $Productos = Productos::all();


        // return view('productos/lista', [
        //     'productos' => $Productos
        // ]);
    }

    public function create()
    {
        $proveedores = Proveedores::all();

        return view('productos/create', [
            'proveedores' =>  $proveedores,
            'precios'     => null
        ]);
    }

    public function createProductos(Request $request)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'serial'      => 'required',

        ]);
        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar producto');

            return redirect()->back();
        }
        $Productos = new Productos();
        $Productos->serial = $request->input('serial');
        $Productos->nombre = $request->input('nombre');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->presentacion = $request->input('presentacion');
        $Productos->registro = $request->input('registro');
        $Productos->color = $request->input('color');
        $Productos->save();




        $request->session()->flash('alert-success', 'Producto registrado con exito!');

        return redirect()->route('productos.lista');
    }

    public function update($id)
    {

        $Productos = Productos::where('id', $id)->first();


        return view('productos/create', [
            'producto' => $Productos,

        ]);
    }

    public function updateProductos(Request $request, $Productos_id)
    {

        $Productos = Productos::where('id', $Productos_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'serial'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar productos');

            return redirect()->back();
        }
        $Productos->serial = $request->input('serial');
        $Productos->nombre = $request->input('nombre');
        $Productos->cod_barra = $request->input('cod_barra');
        $Productos->presentacion = $request->input('presentacion');
        $Productos->registro = $request->input('registro');
        $Productos->color = $request->input('color');

        $Productos->save();

        $request->session()->flash('alert-success', 'Producto actualizado con exito!');


        return redirect()->route('productos.lista');
    }


    public function deleteProductos()
    {
    }
}
