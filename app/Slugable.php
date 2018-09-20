<?php

namespace App;

trait Slugable {

  /**
   * generate unique slug for this model
   * @param string $base
   * @return string
   */
  public function generateSlug(string $base): string {

    $i = 0;
    do {
      $suffix = $i == 0 ? '' : "-$i";
      $slug = str_slug($base . $suffix);
      $count = self::query()
        ->where('slug', '=', $slug)
        ->where('id', '<>', $this->id)
        ->count();
      $unique = $count == 0;
      $i++;

    } while (!$unique);

    return $slug;
  }

}