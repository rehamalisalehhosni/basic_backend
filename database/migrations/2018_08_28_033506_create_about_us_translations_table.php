<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsTranslationsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('about_us_translations', function (Blueprint $table) {

      // mandatory fields
      $table->increments('id');
      $table->string('locale')->index();

      // change article to your model name
      $table->integer('aboutus_id')->unsigned();
      $table->unique(['aboutus_id', 'locale']);
      $table->foreign('aboutus_id')->references('id')->on('aboutus')->onDelete('cascade');

      // add here your respective model attributes
      // which you want to be translated
    

      $table->string('title');
      $table->text('description');
      $table->text('image_big');
      $table->text('first_image');
      $table->text('second_image');
      $table->text('theme');
      $table->text('sort');

    });
  }

  public function up()
  {
    Schema::create('about_us_translations', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::drop('about_us_translations');
  }
}
