<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $this->call([
      CountriesTableSeeder::class,
      GenresTableSeeder::class,
      UsersTableSeeder::class,
      FilmsTableSeeder::class,
      CommentsTableSeeder::class,
    ]);
  }
}
