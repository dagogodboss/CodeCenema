<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Intervention\Image\Image as InterventionImage;

/**
 * App\Image
 *
 * @property int $id
 * @property string $path
 * @property int|null $width
 * @property int|null $height
 * @property int|null $parent_id
 * @property string|null $modifier specified of image operations for childs: resize, fit, etc
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $childs
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereModifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereWidth($value)
 * @mixin \Eloquent
 */
class Image extends Model {

  public function childs() {
    return $this->hasMany(Image::class, 'parent_id');
  }

  /** save image size to db */
  public function saveSizes() {
    if ($this->exists && (is_null($this->width) || is_null($this->height))) {
      $path = public_path($this->path);
      if (file_exists($path)) {
        $image = ImageManager::instance()->make($path);
        $this->width = $image->width();
        $this->height = $image->height();
        $this->save();
      }
    }

    return $this;
  }

  /**
   * fit image into frame with saving proportion
   * @param int $width
   * @param int $height
   * @return Image
   * @throws Exception
   */
  public function fit(int $width, int $height) {
    if (!$this->exists) return $this;

    if (!file_exists(public_path($this->path))) return $this;

    if ($width <= 0) {
      throw new Exception('Width must be greater 0');
    }

    if ($height <= 0) {
      throw new Exception('Height must be greater 0');
    }

    $this->saveSizes();

    //the condition under which you can return the original: if the width and height of the image coincide with the given
    if ($this->width == $width && $this->height == $height) return $this;

    $modifier = "f"; //fit
    $modifier .= is_null($width) ? "_" : $width;
    $modifier .= "x";
    $modifier .= is_null($height) ? "_" : $height;

    //search in db
    /** @var Image $ormImage */
    $ormImage = self::query()
      ->where('modifier', '=', $modifier)
      ->where('parent_id', '=', $this->id)
      ->first();

    if ($ormImage) return $ormImage;

    //create a copy, set the size and save to the file system
    $path = public_path($this->path);

    /** @var InterventionImage $image */
    $image = ImageManager::instance()->make($path);
    $image->fit($width, $height, function ($constraint) {
      $constraint->upsize();
    });

    //save the resized image to the file system
    $dir = pathinfo($this->path, PATHINFO_DIRNAME);
    $ext = mb_strtolower(pathinfo($this->path, PATHINFO_EXTENSION));
    $name = pathinfo($this->path, PATHINFO_FILENAME);
    $newPath = "{$dir}/{$name}-{$modifier}.{$ext}";
    $image->save(public_path($newPath));

    //save the resized image to the db
    $ormImage = new self;
    $ormImage->path = $newPath;
    $ormImage->width = $width;
    $ormImage->height = $height;
    $ormImage->parent_id = $this->id;
    $ormImage->modifier = $modifier;
    $ormImage->save();
    return $ormImage;
  }

  public function resize(int $width = null, int $height = null) {
    if (!$this->exists) return $this;

    if (!file_exists(public_path($this->path))) return $this;

    if (is_null($width) && is_null($height)) throw new Exception("At least one of the width and height parameters must be a number");

    if (!is_null($width) && $width <= 0) throw new Exception('Width must be greater 0');

    if (!is_null($height) && $height <= 0) throw new Exception('Height must be greater 0');

    $this->saveSizes();

    //Only the width is specified and it coincides with the width of the original, then return this
    if (is_null($height) && $width == $this->width) return $this;

    //Only the height is given and it coincides with the height of the original, then return this
    if (is_null($width) && $height == $this->height) return $this;

    //Both width and height are specified, and they coincide with the original, then return this
    if ($width == $this->width && $height == $this->height) return $this;

    $modifier = "r"; //resize
    $modifier .= is_null($width) ? "_" : $width;
    $modifier .= "x";
    $modifier .= is_null($height) ? "_" : $height;

    //search in db by modifier
    $ormImage = self::query()
      ->where('modifier', '=', $modifier)
      ->where('parent_id', '=', $this->id)
      ->first();

    if ($ormImage) return $ormImage;

    //create a copy, set the size and save to the file system
    $path = public_path($this->path);

    /** @var InterventionImage $image */
    $image = ImageManager::instance()->make($path);
    $image->resize($width, $height, function ($constraint) {
      $constraint->aspectRatio();
      $constraint->upsize();
    });

    //save the resized image to the file system
    $dir = pathinfo($this->path, PATHINFO_DIRNAME);
    $ext = mb_strtolower(pathinfo($this->path, PATHINFO_EXTENSION));
    $name = pathinfo($this->path, PATHINFO_FILENAME);
    $newPath = "{$dir}/{$name}-{$modifier}.{$ext}";
    $image->save(public_path($newPath));

    //save the resized image to the db
    $ormImage = new self;
    $ormImage->path = $newPath;
    $ormImage->width = $image->width();
    $ormImage->height = $image->height();
    $ormImage->modifier = $modifier;
    $ormImage->parent_id = $this->id;
    $ormImage->save();
    return $ormImage;
  }

}
