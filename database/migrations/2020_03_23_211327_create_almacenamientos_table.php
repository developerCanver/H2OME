<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmacenamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almacenamientos', function (Blueprint $table) {
            $table->increments('id_almacenamiento');
            $table->string('nombreAlmacenamiento');
            $table->integer('capacidadAlmacenamiento');
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
        Schema::dropIfExists('almacenamientos');
    }
}
