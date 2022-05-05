<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Compras;
use App\Models\Lotes;
use App\Models\Ubicacion;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');

    }

    public function getClientes(Request $request)
    {

        if ($request->get('filtro') == null){
            if($request){

                $query= trim($request->get('search'));
                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                ->join('compras', 'compras.id', '=', 'clientes.producto')
                ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'compras.serial AS nombrep', 'clientes.*')
                ->where('cargorecibe','LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                // ->get();
                ->simplePaginate(10);

            }
            return view('Clientes/mostrar', [
                'clientes' => $clientes,
                'search' => $query
            ]);

        
        } else
            if($request->get('filtro') == 1){ //mas reciente                
                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                ->join('compras', 'compras.id', '=', 'clientes.producto')
                ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'compras.serial AS nombrep', 'clientes.*')
                ->orderby('updated_at', 'desc')
                // ->get();
                ->simplePaginate(10);

                
                return view('Clientes/mostrar', [
                    'clientes' => $clientes
                ]);
            }else
                
                    if ($request->get('filtro') == 2){//Alfabetico
                        $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                        ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                        ->join('compras', 'compras.id', '=', 'clientes.producto')
                        ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'compras.serial AS nombrep', 'clientes.*')
                        ->orderby('nombre', 'asc')
                        // ->get();
                        ->simplePaginate(10);

                        
                        return view('Clientes/mostrar', [
                            'clientes' => $clientes
                        ]);
                    }else
                            if ($request->get('filtro') == 3){//Alfabetico
                                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                                ->join('compras', 'compras.id', '=', 'clientes.producto')
                                ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'compras.serial AS nombrep', 'clientes.*')
                                ->orderby('estado', 'desc')
                                // ->get();
                                ->simplePaginate(10);

                                
                                return view('Clientes/mostrar', [
                                    'clientes' => $clientes
                                ]);
                            }

       
    }

    public function create()
    {
        $ubicacion = Ubicacion::all();
        $clientes = Clientes::all();
        $compras = Compras::all();

        return view('Clientes/create', [
            'ubicacion' => $ubicacion,
            'clientes' => $clientes,
            'compras' => $compras,

        ]);
    }

    public function createClientes(Request $request)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',
            'departamento'      => 'required',
            'producto'      => 'required',




        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }

        $ubicacion = Ubicacion::all();


        $clientes = new Clientes();
        $clientes->responsable_id = Auth::user()->id;
        $clientes->nombre =  $request->input('name');
        $clientes->producto =  $request->input('producto');
        $clientes->cargorecibe =  $request->input('cargorecibe');
        $clientes->departamento = $request->input('departamento');
        $clientes->giro = $request->input('giro');
        $clientes->registro = $request->input('registro');
        $clientes->direccion = $request->input('direccion');



        $clientes->save();

        $request->session()->flash('alert-success', 'Cliente registrado con exito!');

        return redirect()->route('clientes.lista');
    }

    public function update($id)
    {
        $clientes = Clientes::where('id', $id)->first();
        $ubicacion = Ubicacion::all();        
        $compras = Compras::all();


        return view('Clientes/edit', [
            'cliente' => $clientes,
            'ubicacion' => $ubicacion,
            'compras' => $compras,
        ]);
    }

    public function updateClientes(Request $request, $clientes_id)
    {
        // dd($request->all());

        $clientes = Clientes::where('id', $clientes_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',
            'departamento'      => 'required',
            'producto'      => 'required',
            'estado'      => 'required',



        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }
        $ubicacion = Ubicacion::all();


        $clientes->responsable_id = Auth::user()->id;
        $clientes->nombre =  $request->input('name');
        $clientes->estado =  $request->input('estado');
        $clientes->producto =  $request->input('producto');
        $clientes->cargorecibe =  $request->input('cargorecibe');
        $clientes->departamento = $request->input('departamento');
        $clientes->giro = $request->input('giro');
        $clientes->registro = $request->input('registro');
        $clientes->direccion = $request->input('direccion');
        $clientes->save();

        $request->session()->flash('alert-success', 'Cliente actualizado con exito!');


        return redirect()->route('clientes.lista');
    }

    public function getOneClient(Request $request)
    {

        $dui = $request->input('dui');
        $cliente = Clientes::where('dui', $dui)->first();

        $compras = Compras::all();

        $lotes = Lotes::all();

        return view('ventas/create', [
            'cliente' => $cliente
        ]);
    }


    public function deleteClientes()
    {
    }
}
