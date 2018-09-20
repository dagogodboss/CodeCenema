<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {

    $now = new DateTime();

    $table = DB::table('genres');
    $table->insert([
      'slug'       => "drama",
      'name'       => "Drama",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "melodrama",
      'name'       => "Melodrama",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "western",
      'name'       => "Western",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "detective",
      'name'       => "Detective",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "thriller",
      'name'       => "Thriller",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "action",
      'name'       => "Action",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "historical",
      'name'       => "Historical",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "musical",
      'name'       => "Musical",
      'created_at' => $now,
    ]);

    $table->insert([
      'slug'       => "sci-fi",
      'name'       => "Sci-Fi",
      'created_at' => $now,
    ]);

  }
}