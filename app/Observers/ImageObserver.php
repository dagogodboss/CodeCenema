<?php

namespace App\Observers;

use App\Image;
use Illuminate\Support\Facades\File;

class ImageObserver {

  public function deleting(Image $image) {

    foreach ($image->childs()->get() as $child) {
      $child->delete();
    }

    File::delete(public_path($image->path));
  }

}