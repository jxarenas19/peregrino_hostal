<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHostalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_hostales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('latitude');
            $table->string('length');
            $table->string('email');
            $table->string('name-visual');
            $table->longText('mini_description-visual');
            $table->longText('description-visual');
            $table->string('address-visual');
            $table->timestamps();
        });
        Schema::create('hp_hostales_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('hostal_id')->unsigned();
            $table->string('name');
            $table->longText('mini_description');
            $table->longText('description');
            $table->string('address');
            $table->string('locale')->index();
            $table->string('icon');
            $table->unique(['hostal_id','locale']);
            $table->foreign('hostal_id')->references('id')->on('hp_hostales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hp_hostales');
        Schema::dropIfExists('hp_hostal_translations');
    }
}
