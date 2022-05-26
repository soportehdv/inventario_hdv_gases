<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class TiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos')->insert([
            'nombre_id'            => 'OXIGENO 8.5',
            'presentacion_m3_id'=> '8.5',
            'color_id'          => 'BLANCO',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'AIRE MEDICINAL',
            'presentacion_m3_id'=> '6.5',
            'color_id'          => 'NEGRO-BLANCO',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'OXIGENO 1M3',
            'presentacion_m3_id'=> '1',
            'color_id'          => 'BLANCO',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'NITROGENO',
            'presentacion_m3_id'=> '5.8',
            'color_id'          => 'NEGRO',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'OXIDO NITRICO',
            'presentacion_m3_id'=> '1.535',
            'color_id'          => 'VERDE-BLANCO',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'DIOXIDO CARBONO',
            'presentacion_m3_id'=> '25',
            'color_id'          => 'VERDE',
        ]);
        DB::table('tipos')->insert([
            'nombre_id'            => 'HELONTIX',
            'presentacion_m3_id'=> '6.5',
            'color_id'          => 'CAFE-BLANCO',
        ]);
    }
}
