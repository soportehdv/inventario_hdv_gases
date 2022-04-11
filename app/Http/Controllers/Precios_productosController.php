<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Precios_productos;
use Illuminate\Support\Facades\Validator;


class Precios_productosController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');
    
        }
        
    public function getPrecios()
    {
        $precios = Precios_productos::all();

        return view('Precios/mostrar', [
            'precios' =>  $precios
        ]);
    }

    public function create()
    {
        return view('Precios/create');
    }

    public function createPrecios(Request $request)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }


        $Precios = new Precios_productos();
        $Precios->titulo =  $request->input('name');
        $Precios->precio =  $request->input('precio');
        $Precios->unidades = $request->input('unidades');
        $Precios->tipo = $request->input('tipo');

        $Precios->save();

        $request->session()->flash('alert-success', 'Precio registrado con exito!');

        return redirect()->route('precios.lista');
    }

    public function update($id)
    {
        $Precios = Precios_productos::where('id', $id)->first();

        return view('Precios/create', [
            'precio' => $Precios
        ]);
    }

    public function updatePrecios(Request $request, $Precios_id)
    {

        $Precios = Precios_productos::where('id', $Precios_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }

        $Precios->titulo =  $request->input('name');
        $Precios->precio =  $request->input('precio');
        $Precios->unidades = $request->input('unidades');
        $Precios->tipo = $request->input('tipo');
        $Precios->save();

        $request->session()->flash('alert-success', 'Precio actualizado con exito!');


        return redirect()->route('precios.lista');
    }
}
