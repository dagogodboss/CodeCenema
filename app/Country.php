<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Country
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Film[] $films
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereTitle($value)
 * @mixin \Eloquent
 */
class Country extends Model {

  public function films() {
    return $this->hasMany(Film::class);
  }

}