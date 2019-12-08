<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_seasons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->timestamps();
        });
        Schema::create('hp_seasons_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('season_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['season_id','locale']);
            $table->foreign('season_id')->references('id')
                ->on('hp_seasons')->onDelete('cascade');
            $table->string('icon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hp_seasons');
        Schema::dropIfExists('hp_seasons_translations');
    }
}
