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

            $table->string('serial');
            $table->string('registro');


            $table->integer('estado_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('tipo');
            $table->string('estado_ubi')->nullable()->default("Bodega");
            $table->date('fecha_vencimiento');
            $table->integer('unidades');
            $table->integer('uni');
            $table->string('lote');
            $table->string('limpieza');
            $table->string('sello');
            $table->string('eti_producto');
            $table->string('prueba');
            $table->string('estandar');
            $table->string('eti_lote');
            $table->string('integridad');
            $table->string('aprobado');
            $table->string('rechazado');

            $table->integer('status');//activo o inactivo



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
