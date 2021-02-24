<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispositivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->increments('id_dispositivo');
            $table->string('nombreDispositivo',45);
            $table->string('marca',45);
            $table->string('utilizado',1);
            $table->text('descripcionDispositivo');
            $table->timestamps();
            
            $table->unsignedInteger('tipoSensor_id');            
            
            $table->foreign('tipoSensor_id')->references('id_tipoSensor')->on('tipo_sensors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositivos');
    }
}
