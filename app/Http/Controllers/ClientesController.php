<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Lotes;
use App\Models\Productos;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClientes(Request $request)
    {

        if ($request->get('filtro') == null){
            if($request){

                $query= trim($request->get('search'));
                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'clientes.*')
                ->where('cargorecibe','LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                ->get();
            }
            return view('Clientes/mostrar', [
                'clientes' => $clientes,
                'search' => $query
            ]);

        
        } else
            if($request->get('filtro') == 1){ //mas reciente                
                $clientes = Clientes::orderby('created_at', 'desc')->get();
                
                return view('Clientes/mostrar', [
                    'clientes' => $clientes
                ]);
            }else
                
                    if ($request->get('filtro') == 2){//Alfabetico
                        $clientes = Clientes::orderby('nombre', 'asc')->get();
                        
                        return view('Clientes/mostrar', [
                            'clientes' => $clientes
                        ]);
                    }
       
    }

    public function create()
    {
        $ubicacion = Ubicacion::all();

        return view('Clientes/create', [
            'ubicacion' => $ubicacion,

        ]);
    }

    public function createClientes(Request $request)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }

        $ubicacion = Ubicacion::all();

        $Clientes = new Clientes();
        $Clientes->responsable_id = Auth::user()->id;
        $Clientes->nombre =  $request->input('name');
        $Clientes->cargorecibe =  $request->input('cargorecibe');
        $Clientes->departamento = $request->input('departamento');
        $Clientes->giro = $request->input('giro');
        $Clientes->registro = $request->input('registro');
        $Clientes->direccion = $request->input('direccion');



        $Clientes->save();

        $request->session()->flash('alert-success', 'Cliente registrado con exito!');

        return redirect()->route('clientes.lista');
    }

    public function update($id)
    {
        $Clientes = Clientes::where('id', $id)->first();
        $ubicacion = Ubicacion::all();

        return view('Clientes/create', [
            'cliente' => $Clientes,
            'ubicacion' => $ubicacion,

        ]);
    }

    public function updateClientes(Request $request, $Clientes_id)
    {

        $Clientes = Clientes::where('id', $Clientes_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }
        $ubicacion = Ubicacion::all();


        $Clientes->responsable_id = Auth::user()->id;
        $Clientes->nombre =  $request->input('name');
        $Clientes->cargorecibe =  $request->input('cargorecibe');
        $Clientes->departamento = $request->input('departamento');
        $Clientes->giro = $request->input('giro');
        $Clientes->registro = $request->input('registro');
        $Clientes->direccion = $request->input('direccion');
        $Clientes->save();

        $request->session()->flash('alert-success', 'Cliente actualizado con exito!');


        return redirect()->route('clientes.lista');
    }

    public function getOneClient(Request $request)
    {

        $dui = $request->input('dui');
        $cliente = Clientes::where('dui', $dui)->first();

        $productos = Productos::all();

        $lotes = Lotes::all();

        return view('ventas/create', [
            'cliente' => $cliente
        ]);
    }


    public function deleteClientes()
    {
    }
}
