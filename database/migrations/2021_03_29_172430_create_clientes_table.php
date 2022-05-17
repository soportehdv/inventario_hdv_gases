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
                $table->integer('responsable_id')->unsigned();
                $table->string('nombre');
                $table->string('estado')->nullable()->default("pendiente");
                $table->string('cargorecibe')->nullable();
                $table->string('direccion')->nullable();
                $table->integer('departamento')->unsigned();
                $table->string('registro')->nullable();
                $table->string('tipo')->nullable();
                $table->integer('cantidad')->unsigned();

               
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
