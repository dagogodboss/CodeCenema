<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('countries');
    $table->insert([
      'code'  => "us",
      'title' => "USA",
    ]);
    $table->insert([
      'code'  => "it",
      'title' => "Italy",
    ]);
    $table->insert([
      'code'  => "uk",
      'title' => "United Kingdom",
    ]);
    $table->insert([
      'code'  => "fr",
      'title' => "France",
    ]);
  }

}