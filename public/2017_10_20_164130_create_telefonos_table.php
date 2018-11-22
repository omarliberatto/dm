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

            $table->increments('id');
            $table->string('alias');

            $table->integer('telefonoscache_id')->unsigned();
            $table->foreign('telefonoscache_id')
                ->references('id')->on('telefonoscache');

            $table->integer('ubicacion_id')->unsigned();
            $table->foreign('ubicacion_id')
                ->references('id')->on('ubicaciones');

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
        Schema::dropIfExists('telefonos');
    }
}
