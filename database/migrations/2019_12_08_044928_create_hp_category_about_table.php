<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHpCategoryAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hp_category_about', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name-visual');
            $table->timestamps();
        });
        Schema::create('hp_category_about_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->unique(['category_id','locale']);
            $table->foreign('category_id')->references('id')
                ->on('hp_category_about')->onDelete('cascade');
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
        Schema::dropIfExists('hp_category_about');
        Schema::dropIfExists('hp_category_about_translations');
    }
}
