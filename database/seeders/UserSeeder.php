<?php

namespace Database\Seeders;
use \Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'cargo' => 'Administrador',
            'email' => 'admin@admin.com',            
            'password' => bcrypt('1234'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Andres osorio',
            'cargo' => 'jefe enfermeria',
            'email' => 'andreosorio@pedidos.com',
            'password' => bcrypt('1234'),
            'rol' => 'ventas'
        ]);
    }
}
