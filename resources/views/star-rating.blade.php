@php
  /**
   * @var int $rating
   */
@endphp
<ul class="list-unstyled star-rating">
  @for($i = 1; $i <= 5; $i++)
    <li>
      <i class="fa {{ $rating >= $i  ? 'fa-star' : 'fa-star-o'}}"></i>
    </li>
  @endfor
</ul>