<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('films', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('description');
      $table->string('realease_date');
      $table->float('rating', 2, 1);
      $table->float('ticket_price', 4, 2);

      //country
      $table->unsignedInteger('country_id')->nullable();
      $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('set null');

      //genre
      $table->unsignedInteger('genre_id')->nullable();
      $table->foreign('genre_id')->references('id')->on('genres')->onUpdate('cascade')->onDelete('set null');

      //photo
      $table->unsignedInteger('photo_id')->nullable();
      $table->foreign('photo_id')->references('id')->on('images')->onUpdate('cascade')->onDelete('set null');

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('films');
  }
}
