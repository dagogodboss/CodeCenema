@php
  /**
   * @var \App\Film $film
   */
  $filmUrl = route('films.show', $film->slug);
@endphp
<article class="card film-card pull-left">
  <card class="header">
      <h2 class="card-title text-center text-muted pt-1">
          Place order for Ticket  Here  
      </h2>
  </card>
  <a class="card-img-top" href="#">
      <img src="{{ asset('/uploads/ticket.jpg') }}" alt="{{ $film->title() }}" class="img-fluid">
  </a>
  <div class="card-body">
    <h5 class="card-title mb-2">
      <a href="{{ $filmUrl }}">
        <span class="film-name">{{ $film->name }}</span>
        <span class="text-muted">({{ $film->realease_date->format('Y') }})</span>
      </a>
    </h5>
    <div class="form-row mb-2 align-items-center">
      <div class="col col-auto h-100">
        @include('star-rating', ['rating' => $film->rating])
      </div>
      <div class="col col-auto">
        <a class="comments-count d-block" href="{{ $filmUrl }}#comments"><i class="fa fa-comment-o mr-1"></i>{{ $film->comments_count }}</a>
      </div>
    </div>
    <p class="card-text film-short">Purchase Cinema Tickets for the Movie right Now</p>
    <a href="{{ $filmUrl }}" class="btn btn-primary">Read More</a>
  </div>
</article>