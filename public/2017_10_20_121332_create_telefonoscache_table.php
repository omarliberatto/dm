<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonoscacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefonoscache', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('telefonostipo_id')->unsigned();
            $table->foreign('telefonostipo_id')
                ->references('id')->on('telefonostipos');

            $table->integer('lugar_id')->unsigned()->nullable();
            $table->foreign('lugar_id')
                ->references('id')->on('lugares');

            $table->integer('persona_id')->unsigned()->nullable();
            $table->foreign('persona_id')
                ->references('id')->on('personas');

            $table->boolean('visible');
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
        Schema::dropIfExists('telefonoscache');
    }
}
