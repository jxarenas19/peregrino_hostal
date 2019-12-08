<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->string('url');
            $table->boolean('main');
            $table->integer('hostal_id')->unsigned()->nullable(true);
            $table->integer('room_id')->unsigned()->nullable(true);
            $table->foreign('hostal_id')->references('id')
                ->on('hp_hostales');
            $table->foreign('room_id')->references('id')
                ->on('hp_rooms');
            $table->timestamps();
        });
        Schema::create('hp_images_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['image_id','locale']);
            $table->foreign('image_id')->references('id')
                ->on('hp_images')->onDelete('cascade');
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
        Schema::dropIfExists('hp_images');
        Schema::dropIfExists('hp_images_translations');
    }
}
