<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Film
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property \Carbon\Carbon $realease_date
 * @property float $rating
 * @property float $ticket_price
 * @property int|null $country_id
 * @property int|null $genre_id
 * @property int|null $photo_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property-read \App\Country|null $country
 * @property-read \App\Genre|null $genre
 * @property-read \App\Image|null $photo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereGenreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film wherePhotoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereRealeaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereTicketPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Film whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Film extends Model {

  use Slugable;

  protected $dates = [
    'created_at',
    'updated_at',
    'realease_date',
  ];

  public function country() {
    return $this->belongsTo(Country::class);
  }

  public function genre() {
    return $this->belongsTo(Genre::class);
  }

  public function photo() {
    return $this->belongsTo(Image::class);
  }

  public function comments() {
    return $this->morphMany(Comment::class, 'commentable');
  }

  public function year() {
    return $this->realease_date->format('Y');
  }

  public function title() {
    return "$this->name ({$this->year()})";
  }

}