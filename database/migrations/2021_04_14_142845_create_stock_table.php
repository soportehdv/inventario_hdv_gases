<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            // $table->integer('fraccion_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->date('fecha_ingreso');
            $table->date('fecha_vencimiento');
            $table->integer('unidades');
            $table->integer('compra_id')->unsigned();
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
        Schema::dropIfExists('stock');
    }
}
