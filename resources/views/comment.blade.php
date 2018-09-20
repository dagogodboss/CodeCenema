@php
  /**
   * @var \App\Comment $comment
   */
@endphp
<div class="comment card card-body mb-4" data-id="{{ $comment->id }}" data-type="{{ $comment->getMorphClass() }}">
  <header class="comment-header">
    <div class="form-row align-items-center">
      <div class="col col-auto">
        <div class="user-name">{{ $comment->user->name }}</div>
      </div>
      <div class="col">
        <div class="stats">
          <time class="text-muted small">{{ $comment->created_at->format('d.m.y (H:i)') }}</time>
        </div>
      </div>
    </div>
  </header>
  <div class="comment-body">
    <div class="comment-text mb-2">{!! auto_p($comment->body) !!}</div>
  </div>
</div>