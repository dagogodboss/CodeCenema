@php
  /**
   * @var bool $isLocal - display additional controls for development
   * @var \Illuminate\Support\Collection|\App\Film[] $films
   */
@endphp

@extends('layout')

@section('content')

  <div id="toolbar" class="mb-3">
    <a href="{{ route('films.create') }}" class="btn btn-success">Create New Film</a>
  </div>

  <div class="films row">
    @foreach($films as $film)
      <div class="col col-12 col-sm-6 col-lg-4 mb-4">
        @include('film-card')
        @if($isLocal)
          <div class="text-center small card-actions text-muted mt-1">
            <a href="{{ route('films.edit', $film) }}">Edit</a>
          </div>
        @endif
      </div>
    @endforeach
  </div>

  {!! $films->links() !!}
@endsection