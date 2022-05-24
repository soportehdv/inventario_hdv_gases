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
            $table->integer('estado_id')->unsigned();
            $table->string('estado_ubi')->nullable()->default("Bodega");
            $table->date('fecha_vencimiento');
            $table->integer('unidades');
            $table->integer('uni');
            $table->integer('tipo');
            $table->integer('compra_id')->unsigned();
            
            $table->integer('status');

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
