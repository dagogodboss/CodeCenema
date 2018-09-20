<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $now = new DateTime();
    $table = DB::table('users');

    $table->insert([
      'name'       => "Lukas Pierce",
      'email'      => "kosha.industry@gmail.com",
      'password'   => Hash::make('kosha123'),
      'created_at' => $now,
    ]);
  }
}
