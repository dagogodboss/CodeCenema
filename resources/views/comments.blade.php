@php
  /**
   * @var \Illuminate\Support\Collection|\App\Comment[] $comments
   */
@endphp
<div class="mt-5">
  <a name="comments"></a>
  <h4 class="mb-3">Comments</h4>
  <div class="comments mb-4">
    @foreach($comments as $comment)
      @include('comment')
    @endforeach
  </div>

  @if(Auth::check())
    @include('form.comment-form')
  @else
    <hr>
    <p class="small">
      <a href="{{ route('register') }}" class="carrot">Sign Up</a> or
      <a href="{{ route('login') }}" class="carrot">Log In</a> for commenting
    </p>
  @endif
</div>