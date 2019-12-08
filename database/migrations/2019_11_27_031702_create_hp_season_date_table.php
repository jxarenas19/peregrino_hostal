<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpSeasonDateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_seasons_date', function (Blueprint $table) {
            $table->increments('id');
            $table->date('begin');
            $table->date('end');
            $table->integer('season_id')->unsigned();
            $table->foreign('season_id')->references('id')
                ->on('hp_seasons');
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
        Schema::dropIfExists('hp_seasons_date');
    }
}
