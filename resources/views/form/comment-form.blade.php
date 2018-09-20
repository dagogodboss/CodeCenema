@php
  /**
   * @var \Illuminate\Database\Eloquent\Model $commentable
   */

  $user = Auth::user();
@endphp
<form id="comment-form" class="comment-form" method="post" action="{{ route('comment.add') }}">

  {{ csrf_field() }}
  <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
  <input type="hidden" name="commentable_type" value="{{ $commentable->getMorphClass() }}">

  <div class="row">
    <div class="col">
      <div class="username mb-2">{{ $user->name }}</div>
      <textarea name="body" class="form-control autosize" rows="5" placeholder="{{ __("Your comment") }}..."></textarea>
      <div class="mt-3">
        <input type="submit" class="btn btn-primary px-4" disabled value="{{ __("Submit") }}">
        <i class="fa fa-spin fa-refresh text-muted ml-3 loader invisible"></i>
      </div>
    </div>
  </div>
</form>