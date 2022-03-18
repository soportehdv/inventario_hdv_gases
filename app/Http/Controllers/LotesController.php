<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lotes;
use App\Models\Proveedores;
use App\Models\Precios_productos;
use Illuminate\Support\Facades\Validator;




class LotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLotes($producto_id)
    {

        $lotes = Lotes::where('producto_id', $producto_id)
            ->join('precios_productos', 'precios_productos.id', '=', 'lotes.precio_id')
            ->select('lotes.*', 'precios_productos.precio as precio_venta')
            ->get();


        return view('lotes/mostrar', [
            'lotes' => $lotes,
            'producto_id' => $producto_id

        ]);
    }

    public function create($producto_id)
    {

        $proveedores = Proveedores::all();
        $precios = Precios_productos::all();

        return view('Lotes/create', [
            'producto_id' => $producto_id,
            'proveedores' => $proveedores,
            'precios'     => $precios
        ]);
    }

    public function createLotes(Request $request, $producto_id)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',


        ]);
        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar lote');

            return redirect()->back();
        }

        $Lotes = new Lotes();
        $Lotes->nombre = $request->input('name');
        $Lotes->precio_compra = $request->input('precio_compra');
        $Lotes->proveedor_id = $request->input('proveedor_id');
        $Lotes->fecha_vence = $request->input('fecha_vence');

        $Lotes->blister = $request->input('blister');
        $Lotes->unidad_blister = $request->input('unidad_blister');
        $Lotes->producto_id = $producto_id;
        $Lotes->unidades = $request->input('unidades');
        $Lotes->precio_id = $request->input('precio_id');

        $Lotes->save();
        $request->session()->flash('alert-success', 'Lote registrado con exito!');


        return redirect()->route('lotes.lista', $producto_id);
    }

    public function update($id)
    {

        $Lotes = Lotes::where('id', $id)->first();
        $proveedores = Proveedores::all();
        $precios = Precios_productos::all();


        return view('Lotes/create', [
            'lote' => $Lotes,
            'proveedores' => $proveedores,
            'precios'   => $precios

        ]);
    }

    public function updateLotes(Request $request, $Lotes_id)
    {

        $Lotes = Lotes::where('id', $Lotes_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar lote');

            return redirect()->back();
        }

        $Lotes->nombre = $request->input('name');
        $Lotes->precio_compra = $request->input('precio_compra');
        $Lotes->fecha_vence = $request->input('fecha_vence');
        $Lotes->blister = $request->input('blister'); //Blister por caja si aplica
        $Lotes->unidad_blister = $request->input('unidad_blister'); //pastilla por blister si aplica
        $Lotes->precio_id = $request->input('precio_id');
        $Lotes->proveedor_id = $request->input('proveedor_id');
        $Lotes->unidades = $request->input('unidades'); //Unidades por todo el stock (pastillas o no)

        $request->session()->flash('alert-success', 'Lote actualizado con exito!');

        $Lotes->save();


        return redirect()->route('lotes.lista', $Lotes->producto_id);
    }

    public function cargar(Request $request)
    {
        $lotes = Lotes::where('id', $request->input('lote_id'))->first();

        $lotes->unidades = $lotes->unidades + ($request->input('stock') * $lotes->unidad_blister * $lotes->blister);
        $lotes->stock += $request->input('stock');

        $lotes->save();
        $request->session()->flash('alert-success', 'Lote cargado con exito!');


        return redirect()->route('productos.lista');
    }

    public function getAll()
    {

        $lotes = Lotes::join('precios_productos', 'precios_productos.id', '=', 'lotes.precio_id')
            ->select('lotes.*', 'precios_productos.precio as precio_venta')
            ->get();

        return view('Lotes/mostrar', [
            'lotes' => $lotes
        ]);
    }
}
