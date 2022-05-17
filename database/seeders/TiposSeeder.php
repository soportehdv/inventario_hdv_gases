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
            'nombre' => 'Oxigeno 8.5',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Aire medicinal',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Oxigeno 1 m3',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Nitrogeno',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Oxido nitrico',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Dioxido carbono',
        ]);
        DB::table('tipos')->insert([
            'nombre' => 'Helontix',
        ]);
    }
}
