<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpPoliticaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_politicas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->timestamps();
        });

        Schema::create('hp_politicas_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('politica_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['politica_id','locale']);
            $table->foreign('politica_id')->references('id')
                ->on('hp_politicas')->onDelete('cascade');
            $table->string('icon');
        });
        Schema::create('hp_politicas_hostales', function(Blueprint $table)
        {
            $table->integer('politica_id')->unsigned();
            $table->integer('hostal_id')->unsigned();
            $table->foreign('politica_id')->references('id')
                ->on('hp_politicas')->onDelete('cascade');
            $table->foreign('hostal_id')->references('id')
                ->on('hp_hostales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hp_politicas');
        Schema::dropIfExists('hp_politicas_translations');
        Schema::dropIfExists('hp_politicas_hostales');
    }
}
