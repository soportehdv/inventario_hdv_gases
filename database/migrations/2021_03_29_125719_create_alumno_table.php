<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('unidades'); //Pastillas por el lote completo
            $table->integer('blister'); //Blister por caja
            $table->integer('unidad_blister');//pastilla por blister
            $table->integer('stock'); //Cajas por lote
            $table->integer('producto_id');
            $table->float('precio_compra');
            $table->float('fecha_vence');
            $table->integer('proveedor_id');

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
        Schema::dropIfExists('lotes');
    }
}
