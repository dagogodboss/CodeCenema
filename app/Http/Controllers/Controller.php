<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  private $uploadDir = "uploads";

  public function uploadImage(Model $model, string $field = "image") {

    //do not upload for un exists models
    if (!$model->exists) return $model;

    $file = request()->file($field);
    if ($file) {
      $destinationPath = $this->uploadDir;
      $name = uniqid() . '.' . mb_strtolower($file->getClientOriginalExtension());
      $file->move($destinationPath, $name);

      //create new image
      $image = new Image();
      $image->path = "/" . $destinationPath . "/" . $name;
      if ($image->save()) {

        //delete old image
        if ($model->{$field}) $model->{$field}->delete();

        $model->{$field}()->associate($image);
        $model->save();
      }
    }

    return $model;
  }

}