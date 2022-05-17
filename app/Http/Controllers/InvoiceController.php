<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Tipo;
use App\Models\Compras;



class InvoiceController extends Controller
{
    public function sacaSub($categoria){
        $subCate = Compras::where('tipo', $categoria)
        // ->join('compras', 'compras.id', '=', 'stock.compra_id')
        // ->select('compras.serial AS serial')
        ->get();
        return with(["subCate" => $subCate]);
    }
}
