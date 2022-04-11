<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Stock;


class TargetController extends Controller
{
    public function gettarget(Request $request)
    {
        $clientes = Clientes::all();
        $stock = Stock::all();


        return view('targets/target',[
            'clientes'  => $clientes,
            'stock'  => $stock,

        ]);
    }
}
