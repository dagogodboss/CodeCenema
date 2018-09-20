<?php

namespace App\Observers;

use App\User;

class UserObserver {

  public function deleting(User $user) {

    //delete user's comments
    foreach ($user->comments()->get() as $comment) {
      $comment->delete();
    }

  }

}