<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
                $table->id();
                $table->string('dui');
                $table->string('email')->nullable();
                $table->string('tipo');
                $table->string('nombre');
                $table->string('direccion')->nullable();
                $table->string('departamento')->nullable();
                $table->string('registro')->nullable();
                $table->string('nit')->nullable();
                $table->string('giro')->nullable();
                $table->string('telefono')->nullable();
               
                $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
