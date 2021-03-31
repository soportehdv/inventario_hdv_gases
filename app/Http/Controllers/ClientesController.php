<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClientes(){
        
        $Clientes = Clientes::all();

        return view('Clientes/mostrar', [
            'clientes' => $Clientes
        ]);
    }

    public function create(){
        return view('Clientes/create');
    }

    public function createClientes(Request $request){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:clientes',
            
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        $Clientes = new Clientes();
        $Clientes->nombre = $request->input('name');
        $Clientes->email = $request->input('email');
        $Clientes->telefono = $request->input('telefono');
        $Clientes->dui = $request->input('dui');
        $Clientes->save();

        return redirect()->route('clientes.lista');
    }

    public function update($id){
        $Clientes = Clientes::where('id', $id)->first();

        return view('Clientes/create', [
            'cliente' => $Clientes
        ]);

    }

    public function updateClientes(Request $request, $Clientes_id){

        $Clientes = Clientes::where('id', $Clientes_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',
            
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        $Clientes->nombre = $request->input('name');
        $Clientes->email = $request->input('email');
        $Clientes->telefono = $request->input('telefono');
        $Clientes->dui = $request->input('dui');
        $Clientes->save();

        return redirect()->route('clientes.lista');
    }

    public function getOneClient(Request $request){

        $dui = $request->input('dui');
        $cliente = Clientes::where('dui', $dui)->first();

        $productos = Productos::all();

        $lotes = $lotes::all();

        return view('ventas/create', [
            'cliente' => $cliente
        ]);
    } 
    

    public function deleteClientes(){
        
    }
}
