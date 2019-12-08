<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_types_room', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->timestamps();
        });
        Schema::create('hp_types_room_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_room_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['type_room_id','locale']);
            $table->foreign('type_room_id')->references('id')
                ->on('hp_types_room')->onDelete('cascade');
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
        Schema::dropIfExists('hp_types_room');
        Schema::dropIfExists('hp_types_room_translations');
    }
}
