<?php

namespace App\Observers;

use App\Film;

class FilmObserver {

  public function deleting(Film $film) {

    //delete films's comments
    foreach ($film->comments()->get() as $comment) {
      $comment->delete();
    }

  }

}