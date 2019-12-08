<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->integer('hostal_id')->unsigned()->nullable(true);
            $table->foreign('hostal_id')->references('id')
                ->on('hp_hostales');
            $table->string('icon');
            $table->timestamps();
        });
        Schema::create('hp_services_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['service_id','locale']);
            $table->foreign('service_id')->references('id')
                ->on('hp_services')->onDelete('cascade');
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
        Schema::dropIfExists('hp_services');
        Schema::dropIfExists('hp_services_translations');
    }
}
