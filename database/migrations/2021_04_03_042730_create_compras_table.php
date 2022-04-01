<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->integer('producto_id')->unsigned();
            $table->integer('estado_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->date('fecha_ingreso');
            $table->date('fecha_vencimiento');
            $table->integer('unidades');
            $table->integer('lote');
            $table->string('limpieza');
            $table->string('sello');
            $table->string('eti_producto');
            $table->string('prueba');
            $table->string('estandar');
            $table->string('eti_lote');
            $table->string('integridad');



            // $table->float('precio_compra');
            // $table->float('costo_unitario');
            // $table->integer('fraccion_id')->unsigned();
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
        Schema::dropIfExists('compras');
    }
}
