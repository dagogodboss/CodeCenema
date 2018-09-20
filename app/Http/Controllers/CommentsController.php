<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use Auth;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class CommentsController extends Controller {

  public function addComment(StoreComment $request) {

    /** @var Model $commentable */
    $commentable = $request->get('commentable');

    $comment = new Comment();
    $comment->body = $request->input('body');
    $comment->commentable_id = $commentable->id;
    $comment->commentable_type = $commentable->getMorphClass();
    $comment->user_id = Auth::id();
    $comment->save();

    return [
      'comment'        => view('comment', ['comment' => $comment])->render(),
      'comments_total' => $commentable->comments()->count(),
    ];
  }

}