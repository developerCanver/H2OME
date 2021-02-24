<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHogarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hogars', function (Blueprint $table) {
            $table->increments('id_hogar');
            $table->string('nombreHogar');
            $table->string('direccion');
            $table->integer('numeroPersonas');
            $table->integer('numeroGrifos');
            $table->timestamps();
            $table->unsignedInteger('usuario_id');            
            $table->foreign('usuario_id')->references('id')->on('users');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hogars');
    }
}
