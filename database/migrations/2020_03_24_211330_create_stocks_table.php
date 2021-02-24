<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id_stock');
            $table->integer('maximo');
            $table->integer('minimo');
            $table->integer('media');
            $table->timestamps();
            $table->unsignedInteger('almacenamiento_id');            
            $table->foreign('almacenamiento_id')->references('id_almacenamiento')->on('almacenamientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
