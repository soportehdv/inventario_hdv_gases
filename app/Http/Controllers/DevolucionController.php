<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Compras;
use App\Models\Clientes;
use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DevolucionController extends Controller
{
    public function getDevolucion(Request $request)
    {
        $query= trim($request->get('search'));
        $stock = Stock::join('compras', 'compras.id', '=', 'stock.compra_id')
        ->join('estados', 'estados.id', '=', 'stock.estado_id')
        ->select('stock.*','compras.serial as serial', 'compras.lote as lote', 'estados.estado as estados')
        ->where('compras.serial','LIKE', '%' . $query . '%')
        // ->get();
        ->paginate(10);

        return view('devolucion/list', [
            'stock' => $stock,
            'search' => $query
        ]);
    }

}
