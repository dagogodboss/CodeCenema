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
    $now = new DateTime();
    $lukas = \App\User::where('email', '=', 'kosha.industry@gmail.com')->firstOrFail();

    $commentDirs = File::directories(base_path("films-seeder/comments"));

    foreach ($commentDirs as $dir) {

      $filmSlug = pathinfo($dir, PATHINFO_BASENAME);
      if ($film = $this->getFilm($filmSlug)) {

        $files = File::files($dir);
        foreach ($files as $file) {
          if ($commentBody = File::sharedGet($file)) {
            $table->insert([
              'body'             => $commentBody,
              'user_id'          => $lukas->id,
              'commentable_id'   => $film->id,
              'commentable_type' => $film->getMorphClass(),
              'created_at'       => $now,
            ]);
          }
        }
      }
    }
  }

  private function getFilm(string $filmSlug) {
    return \App\Film::whereSlug($filmSlug)->firstOrFail();
  }
}
