<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    $table = DB::table('comments');

    $movies = \App\Film::all(); 
    foreach ($movies as $movie) {
      $comment =  $movie->name ." is a very interesting movie. As both the actors and directors did their possible best to give the movie its quality and sound effect is very ok.";
      $table->insert([
        'created_at'       => \Carbon\Carbon::now(),
        'user_id'          => 1,
        'commentable_id'   => $movie->id,
        'body'             => $comment,
        'commentable_type' => $movie->getMorphClass(),
      ]);
      $comment =  $movie->name ." users remarks are encouraging and people from the cinema where pleased with what they saw from the cinema. And the time I spent in the cinema was worth it";
      $table->insert([
        'created_at'       => \Carbon\Carbon::now(),
        'user_id'          => 2,
        'commentable_id'   => $movie->id,
        'body'             => $comment,
        'commentable_type' => $movie->getMorphClass(),
      ]);
    }
  }
}
