<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Relations\Relation;

class StoreComment extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    if (Auth::check()) {
      return true;
    }

    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {

    //load commentable object
    $commentableId = $this->request->get('commentable_id');
    $commentableType = $this->request->get('commentable_type');
    $model = Relation::getMorphedModel($commentableType);

    /** @var Model $commentable */
    $commentable = call_user_func("$model::find", $commentableId);
    $this->request->set('commentable', $commentable);

    $table = $commentable->getTable();

    return [
      'body'             => 'required|string',
      'commentable_type' => 'required|string|in:film',
      'commentable_id'   => "required|integer|exists:$table,id",
    ];
  }
}