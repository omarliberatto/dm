<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorLugarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sector_lugar', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lugar_id')->unsigned();
            $table->foreign('lugar_id')
                ->references('id')->on('lugares');

            $table->integer('sector_id')->unsigned();
            $table->foreign('sector_id')
                ->references('id')->on('sectores');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sector_lugar');
    }
}
