<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Genre
 *
 * @property int $id
 * @property string $slug
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Film[] $films
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Genre whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Genre extends Model {

  public function films() {
    return $this->hasMany(Film::class);
  }

}