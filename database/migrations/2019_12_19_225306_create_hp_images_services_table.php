<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpImagesServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_images_service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->string('url');
            $table->boolean('main');
            $table->integer('service_id')->unsigned()->nullable(true);
            $table->foreign('service_id')->references('id')
                ->on('hp_services');
            $table->timestamps();
        });
        Schema::create('hp_images_service_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['image_id','locale']);
            $table->foreign('image_id')->references('id')
                ->on('hp_images_service')->onDelete('cascade');
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
        Schema::dropIfExists('hp_images_service');
        Schema::dropIfExists('hp_images_service_translations');
    }
}
