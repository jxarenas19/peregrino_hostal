<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->integer('season_id')->unsigned();
            $table->integer('hostal_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->foreign('season_id')->references('id')
                ->on('hp_seasons');
            $table->foreign('hostal_id')->references('id')
                ->on('hp_hostales');
            $table->foreign('room_id')->references('id')
                ->on('hp_rooms');
            $table->unique(['hostal_id','locale']);
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
        Schema::dropIfExists('hp_prices');
    }
}
