<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lotes;

class LotesController extends Controller
{
    public function getLotes($producto_id){
        
        $lotes = Lotes::where('producto_id', $producto_id)->get();
        

        return view('Lotes/mostrar', [
            'lotes' => $lotes,
            'producto_id' => $producto_id
           
        ]);
    }

    public function create($producto_id){

        return view('Lotes/create',['producto_id' => $producto_id]);
    }

    public function createLotes(Request $request, $producto_id){

    //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
            
            
        ]);
        if($validate->fails()){
           return redirect()->back();
        }

        $Lotes = new Lotes();
        $Lotes->nombre = $request->input('name');
        $Lotes->precio_compra = $request->input('precio_compra');
        $Lotes->fecha_vence = $request->input('fecha_vence');
        $Lotes->stock = $request->input('stock');
        $Lotes->blister = $request->input('blister');
        $Lotes->unidad_blister = $request->input('unidad_blister');
        $Lotes->producto_id = $producto_id;


        $total_unidades = $Lotes->blister * $Lotes->unidad_blister * $Lotes->stock;

        $Lotes->unidades = $total_unidades;
        $Lotes->save();

        return redirect()->route('lotes.lista', $producto_id);
    }

    public function update($id){
        
        $Lotes = Lotes::where('id', $id)->first();
       

        return view('Lotes/create', [
            'lote' => $Lotes,
            
        ]);

    }

    public function updateLotes(Request $request, $Lotes_id){

        $Lotes = Lotes::where('id', $Lotes_id)->first();

        //validamos los datos
        $validate = \Validator::make($request->all(), [
            'name'      => 'required',
           
        ]);

        if($validate->fails()){
            return redirect()->back();
        }

        $Lotes->nombre = $request->input('name');
        $Lotes->precio_compra = $request->input('precio_compra');
        $Lotes->fecha_vence = $request->input('fecha_vence');
        $Lotes->stock = $request->input('stock');
        $Lotes->blister = $request->input('blister');
        $Lotes->unidad_blister = $request->input('unidad_blister');
        $Lotes->producto_id = $producto_id;


        $total_unidades = $Lotes->blister * $Lotes->unidad_blister * $Lotes->stock;

        $Lotes->unidades = $total_unidades;
        $Lotes->save();

       
        return redirect()->route('Lotes.lista');
    }

    public function cargar(Request $request){
        $lotes = Lotes::where('id', $request->input('lote_id'))->first();

        $lotes->unidades = $lotes->unidades + ($request->input('stock') * $lotes->unidad_blister * $lotes->blister); 
        $lotes->stock += $request->input('stock');

        $lotes->save();

        return redirect()->route('productos.lista');

    }
}
