<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_about', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->longText('description-visual');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')
                ->on('hp_category_about');
            $table->timestamps();
        });
        Schema::create('hp_about_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('about_id')->unsigned();
            $table->string('name');
            $table->longText('description');
            $table->string('locale')->index();
            $table->unique(['about_id','locale']);
            $table->foreign('about_id')->references('id')
                ->on('hp_about')->onDelete('cascade');
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
        Schema::dropIfExists('hp_about');
        Schema::dropIfExists('hp_about_translations');
    }
}
