<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estancias', function (Blueprint $table) {
            $table->increments('id_estancia');
            $table->string('nombreEstancia',45);
            $table->string('destinoEstancia',45);
            $table->unsignedInteger('hogar_id'); 
            $table->unsignedInteger('dispositivo_id');           
            $table->foreign('hogar_id')->references('id_hogar')->on('hogars');
            $table->foreign('dispositivo_id')->references('id_dispositivo')->on('dispositivos');
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
        Schema::dropIfExists('estancias');
    }
}
