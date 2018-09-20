<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFilmsDescriptionType extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('films', function (Blueprint $table) {

      //description "varchar" -> "text"
      $table->text('description')->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('films', function (Blueprint $table) {

      //description "text" -> "varchar"
      $table->string('description')->change();
    });
  }
}
