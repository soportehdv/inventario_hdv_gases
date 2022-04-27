<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrays = range(0,80);
        foreach ($arrays as $valor) {
          DB::table('compras')->insert([	
            'producto_id' => 1,
            'estado_id' => 1,
            'proveedor_id' => 1,
            'estado_ubi' => "emergencias",
            'fecha_ingreso' => 2022-04-01,
            'fecha_vencimiento' => 2022-05-21,
            'unidades' => 1,
            'lote' => 4156,       
            'limpieza' => "C",  
            'sello' => "C",     
            'eti_producto' => "C",   
            'prueba' => "C",       
            'estandar' => "C", 
            'eti_lote' => "C", 
            'integridad' => "C",  

          ]);
        }
    }
}
