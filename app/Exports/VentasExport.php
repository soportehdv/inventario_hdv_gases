<?php

namespace App\Exports;

use App\Models\Ventas;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $filtro;
    public $fecha_inicio;
    public $fecha_final;
    public $id;

    public function __construct($filtro = null, $fecha_inicio = null, $fecha_final= null, $id= null){
        
        $this->filtro = $filtro;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->id = $id;

    }

    public function headings(): array
    {
        return [
            'Id',
            'Cliente',
            'Vendedor',
            'Fecha',
        ];
    }
    public function collection()
    {
        if($this->filtro == null){//Todas
            $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
            ->join('users', 'users.id', '=', 'ventas.user_id')
            ->select('ventas.id', 'clientes.nombre AS cliente',  'users.name AS Vendedor', 'ventas.created_at AS Fecha')
            ->get();
        }else
            if($this->filtro == 1){//Por cliente
                $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                ->join('users', 'users.id', '=', 'ventas.user_id')
                ->select('ventas.id', 'clientes.nombre AS cliente',  'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                            ->where('ventas.cliente_id', $this->id)
                            ->get();
            }else
                if($this->filtro == 2){//Por fecha
                    $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                    ->join('users', 'users.id', '=', 'ventas.user_id')
                    ->select('ventas.id', 'clientes.nombre AS cliente',  'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                        ->whereBetween('ventas.created_at', [$this->fecha_inicio, $this->fecha_final])
                        ->get();
                }else
                    if($this->filtro == 3){//Por tipo de cliente
                        $ventas = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
                        ->join('users', 'users.id', '=', 'ventas.user_id')
                        ->select('ventas.id', 'clientes.nombre AS cliente',  'users.name AS Vendedor', 'ventas.created_at AS Fecha')
                            ->where('clientes.tipo', $this->id)
                            ->get();
                    }
         return $ventas;

    }
}