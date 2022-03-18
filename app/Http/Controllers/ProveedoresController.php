<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedores;
use Illuminate\Support\Facades\Validator;


class ProveedoresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getProveedor()
    {

        $proveedor = Proveedores::all();

        return view('proveedor/lista', [
            'proveedores' => $proveedor
        ]);
    }

    public function create()
    {
        return view('proveedor/create');
    }

    public function createProveedor(Request $request)
    {

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:proveedores',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar Proveedor');

            return redirect()->back();
        }
        $proveedor = new Proveedores;
        $proveedor->nombre = $request->input('name');
        $proveedor->email = $request->input('email');

        $proveedor->save();

        $request->session()->flash('alert-success', 'Proveedor registrado con exito!');


        return redirect()->route('proveedor.lista');
    }

    public function update($id)
    {

        $proveedor = Proveedores::where('id', $id)->first();
        return view('proveedor/create', [
            'proveedor' => $proveedor
        ]);
    }

    public function updateProveedor(Request $request, $proveedor_id)
    {

        $proveedor = Proveedores::where('id', $proveedor_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al ingresar Proveedor');

            return redirect()->back();
        }

        $proveedor->nombre = $request->input('name');
        $proveedor->email = $request->input('email');

        $proveedor->save();
        $request->session()->flash('alert-success', 'Proveedor actualizado con exito!');


        return redirect()->route('proveedor.lista');
    }


    public function deleteproveedor()
    {
    }
}
