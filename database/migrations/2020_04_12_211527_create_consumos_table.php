<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumos', function (Blueprint $table) {
            $table->increments('id_consumo');
            $table->float('consumo',4,2);
            $table->date('fechaConsumo');
            $table->timestamps();
            $table->unsignedInteger('administracion_id');            
            $table->foreign('administracion_id')->references('id_administracion')->on('administracions');
            
            // $table->unsignedInteger('factura_id');            
            // $table->foreign('factura_id')->references('id_factura')->on('facturas');
            
            // $table->unsignedInteger('stock_id');            
            // $table->foreign('stock_id')->references('id_stock')->on('stocks');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consumos');
    }
}
