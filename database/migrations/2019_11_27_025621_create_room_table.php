<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostal_id')->unsigned();
            $table->foreign('hostal_id')->references('id')
                ->on('hp_hostales');
            $table->integer('type_room_id')->unsigned();
            $table->foreign('type_room_id')->references('id')
                ->on('hp_types_room');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->timestamps();
        });
        Schema::create('hp_rooms_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('room_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['room_id','locale']);
            $table->foreign('room_id')->references('id')
                ->on('hp_rooms')->onDelete('cascade');
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
        Schema::dropIfExists('hp_rooms');
        Schema::dropIfExists('hp_rooms_translations');
    }
}
