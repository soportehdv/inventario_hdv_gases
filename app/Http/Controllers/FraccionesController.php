<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fracciones;

class FraccionesController extends Controller
{
    public function getfraccion(){
        $fraccion = fracciones::all();

        return view('fracciones/lista', [
            'fracciones' => $fraccion
        ]);
    }
    public function create(){
        return view('fracciones/create');
    }

    public function createfraccion(Request $request){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'nombre'      => 'required',
           
        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar la fracción');

            return redirect()->back();
        }

        $fraccion = new Fracciones();
        $fraccion->nombre = $request->input('nombre');
        $fraccion->unidad = $request->input('unidad');

        $fraccion->save();
        $request->session()->flash('alert-success', 'Usuario registrado con exito!');


        return redirect()->route('fracciones.lista');
    }

    public function update($id){
        $fraccion = fracciones::where('id', $id)->first();

        return view('fracciones/create', [
            'fraccion' => $fraccion
        ]);

    }

    public function updatefraccion(Request $request, $fraccion_id){

        $fraccion = fracciones::where('id', $fraccion_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'unidad'      => 'required',
        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar usuario');

            return redirect()->back();
        }

        $fraccion->nombre = $request->input('nombre');
        $fraccion->unidad = $request->input('unidad');

        $fraccion->save();

        $request->session()->flash('alert-success', 'Precio actualizado con exito!');


        return redirect()->route('fracciones.lista');
    }
    

}
