<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('users');

    $table->insert([
      'name'       => "Ilamini Ayebatonye",
      'email'      => "dagogodboss@gmail.com",
      'password'   => Hash::make('1234dagogo'),
      'created_at' => Carbon\Carbon::now(),
    ]);

    $table->insert([
      'name'       => "Ilamini Dagogo",
      'email'      => "dagogobusness@gmail.com",
      'password'   => Hash::make('1234Dagogo%'),
      'created_at' => Carbon\Carbon::now(),
    ]);
  }
}
