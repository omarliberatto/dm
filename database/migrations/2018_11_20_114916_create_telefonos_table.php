<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {

            $table->increments('id')->unsigned();
            $table->string('alias');

            $table->integer('telefonoscache_id')->unsigned()->nullable();
            $table->foreign('telefonoscache_id')->references('id')->on('telefonoscache');

            $table->unsignedInteger('ubicacion_id')->nullable();
            $table->foreign('ubicacion_id')->references('id')->on('ubicaciones');

            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefonos');
    }
}
