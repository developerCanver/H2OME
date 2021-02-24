<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administracions', function (Blueprint $table) {
            $table->increments('id_administracion');
            $table->string('estado',1);
            $table->date('fechaAdministracion');
            $table->text('descripcionAdministracion');
            $table->timestamps();
            $table->unsignedInteger('estancia_id');            
            $table->foreign('estancia_id')->references('id_estancia ')->on('estancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administracions');
    }
}
