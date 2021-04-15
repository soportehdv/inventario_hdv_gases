<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listaprecios;

class listapreciosController extends Controller
{
    public function getlistaprecios(){
        $listaprecios = listaprecios::all();

        return view('listaprecios/lista', [
            'listas' => $listaprecios
        ]);
    }
    public function create(){
        return view('listaprecios/create');
    }

    public function createlistaprecios(Request $request){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'titulo'      => 'required',
           
        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar usuario');

            return redirect()->back();
        }

        $listaprecios = new listaprecios();
        $listaprecios->titulo = $request->input('titulo');
      
        $listaprecios->save();
        $request->session()->flash('alert-success', 'Usuario registrado con exito!');


        return redirect()->route('listaprecios.lista');
    }

    public function update($id){
        $listaprecios = listaprecios::where('id', $id)->first();

        return view('listaprecios/create', [
            'listaprecios' => $listaprecios
        ]);

    }

    public function updatelistaprecios(Request $request, $listaprecios_id){

        $listaprecios = listaprecios::where('id', $listaprecios_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'titulo'      => 'required',
        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error al ingresar usuario');

            return redirect()->back();
        }

        $listaprecios->titulo = $request->input('titulo');
      
        $listaprecios->save();

        $request->session()->flash('alert-success', 'Precio actualizado con exito!');


        return redirect()->route('listaprecios.lista');
    }
    

}
