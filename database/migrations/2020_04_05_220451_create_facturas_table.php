<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id_factura');
            $table->string('medidor');
            $table->string('codigo');
            $table->integer('consumoPromedio');
            $table->integer('saldoPromedio');
            $table->date('fechaFactura');
            $table->timestamps();
            $table->unsignedInteger('hogar_id');            
            $table->foreign('hogar_id')->references('id_hogar')->on('hogars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
