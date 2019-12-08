<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpConfortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_conforts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->timestamps();
        });

        Schema::create('hp_conforts_translations', function(Blueprint $table)
    {
        $table->increments('id');
        $table->integer('confort_id')->unsigned();
        $table->string('name');
        $table->string('locale')->index();
        $table->unique(['confort_id','locale']);
        $table->foreign('confort_id')->references('id')
            ->on('hp_conforts')->onDelete('cascade');
        $table->string('icon');
    });
        Schema::create('hp_conforts_rooms', function(Blueprint $table)
        {
            $table->integer('confort_id')->unsigned();
            $table->integer('room_id')->unsigned();
            $table->foreign('confort_id')->references('id')
                ->on('hp_conforts')->onDelete('cascade');
            $table->foreign('room_id')->references('id')
                ->on('hp_rooms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hp_confort');
        Schema::dropIfExists('hp_conforts_translations');
        Schema::dropIfExists('hp_conforts_rooms');
    }
}
