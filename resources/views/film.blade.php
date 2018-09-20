@php
  /**
   * @var \App\Film $film
   */
@endphp
@extends('layout')

@section('content')

  <nav class="breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <a class="breadcrumb-item" href="{{ route('films') }}">Films</a>
    <span class="breadcrumb-item active">{{ $film->name }}</span>
  </nav>

  <div class="film-inner">
    <div class="card">
      <div class="card-body">

        <div class="row">

          <div class="col col-12 col-sm-auto mb-3 mb-sm-0">

            <a href="{{ $film->photo->path }}" class="img-zoom" data-fancybox data-caption="{{ $film->title() }})">
              <img src="{{ $film->photo->path }}" alt="{{ $film->title() }}" class="film-caver img-fluid">
            </a>

          </div>

          <div class="col">
            <h1 class="page-title">{{ $film->name }}
              <small class="text-muted">({{ $film->year() }})</small>
            </h1>

            @include('star-rating', ['rating' => $film->rating])

            <div class="object-props">
              <dl class="clearfix">
                <dt>Realease Date</dt>
                <dd>{{ $film->realease_date->format('j F Y') }}</dd>

                <dt>Country</dt>
                <dd>{{ $film->country->title }}</dd>

                <dt>Genre</dt>
                <dd>{{ $film->genre->name }}</dd>

                <dt>Ticket Price</dt>
                <dd>${{ number_format($film->ticket_price, 2) }}</dd>

              </dl>
            </div>

            <div class="film-body">
              {!! auto_p($film->description) !!}
            </div>

          </div>

        </div>

      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col col-md-8">
        @include('comments', ['commentable' => $film])
      </div>
    </div>
  </div>

@endsection