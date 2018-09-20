@php
  /**
   * @var string $title
   * @var \App\Film $film
   * @var \Illuminate\Support\Collection|\App\Country[] $countries
   * @var \Illuminate\Support\Collection|\App\Genre[] $genres
   */
//dump($errors);
@endphp
@extends('layout')

@section('content')
  <form method="post" class="card card-body film-form" action="{{ route('films.store') }}" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" name="id" id="film-id" value="{{ $film->id }}">

    <h4 class="mb-4">{{ $film->exists ? __('Edit Film') : __('Create New Film') }}</h4>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-name">Name</label>
      <div class="col col-12 col-sm">
        <input type="text" name="name" id="film-name"
               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
               value="{{ old('name', $film->name) }}" required autocomplete="off">
        @if($errors->has('name'))
          <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-description">Description</label>
      <div class="col col-12 col-sm">
        <textarea type="text" name="description"
                  class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                  autocomplete="off" rows="5"
                  id="film-description" required>{{ old('description', $film->description) }}</textarea>
        @if($errors->has('description'))
          <div class="invalid-feedback">{{ $errors->first('description') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-realease_date">Realease Date</label>
      <div class="col col-12 col-sm">
        @php
          $filmRealeaseDate = $film->realease_date ? $film->realease_date->format('Y-m-d') : null;
        @endphp
        <input type="date" name="realease_date" id="film-realease_date"
               class="form-control{{ $errors->has('realease_date') ? ' is-invalid' : '' }}"
               autocomplete="off"
               value="{{ old('realease_date', $filmRealeaseDate) }}" required>
        @if($errors->has('realease_date'))
          <div class="invalid-feedback">{{ $errors->first('realease_date') }}</div>
        @endif
      </div>
    </div>


    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-country">Country</label>
      <div class="col col-12 col-sm">
        @php $countryId = old('country', $film->country_id); @endphp
        <select name="country" id="film-country" required
                class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}">
          <option value="">Select Country</option>
          @foreach($countries as $country)
            <option value="{{ $country->id }}"{{ $country->id == $countryId ? ' selected' : null }}>
              {{ $country->title }}
            </option>
          @endforeach
        </select>
        @if($errors->has('country'))
          <div class="invalid-feedback">{{ $errors->first('country') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-genre">Genre</label>
      <div class="col col-12 col-sm">
        @php $genreId = old('genre', $film->genre_id); @endphp
        <select name="genre" id="film-genre" required
                class="form-control{{ $errors->has('genre') ? ' is-invalid' : '' }}">
          <option value="">Select Genre</option>
          @foreach($genres as $genre)
            <option value="{{ $genre->id }}"{{ $genre->id == $genreId ? ' selected' : null }}>
              {{ $genre->name }}
            </option>
          @endforeach
        </select>
        @if($errors->has('genre'))
          <div class="invalid-feedback">{{ $errors->first('genre') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-rating">Rating</label>
      <div class="col col-12 col-sm">
        @php $rating = old('rating', $film->rating); @endphp
        <select id="film-rating" name="rating" required
                class="form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}">
          <option value="">Select Rating</option>
          @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}"{{ $i == $rating ? ' selected' : '' }}>{{ $i }}</option>
          @endfor
        </select>
        @if($errors->has('rating'))
          <div class="invalid-feedback">{{ $errors->first('rating') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <label class="col col-12 col-sm-3 col-form-label" for="film-ticket_price">Ticket Price (USD)</label>
      <div class="col col-12 col-sm">
        <input type="number" name="ticket_price" id="film-ticket_price" required
               class="form-control{{ $errors->has('ticket_price') ? ' is-invalid' : '' }}"
               autocomplete="off"
               value="{{ old('ticket_price', $film->ticket_price) }}" step="0.01" min="0" max="99.99">
        @if($errors->has('ticket_price'))
          <div class="invalid-feedback">{{ $errors->first('ticket_price') }}</div>
        @endif
      </div>
    </div>

    <div class="form-group row">
      <div class="col col-12 col-sm-3 col-form-label">Photo</div>
      <div class="col col-12 col-sm">
        <div><input type="file" name="photo" accept="image/jpeg,image/png"{{ !$film->photo ? ' required' : '' }}></div>
        @if($errors->has('photo'))
          <div class="invalid-feedback">{{ $errors->first('photo') }}</div>
        @endif

        @if($film->photo)
          <img src="{{ $film->photo->resize(300, 300)->path }}" class="d-block mt-3">
        @endif
      </div>
    </div>

    <div class="form-group row">
      <div class="col col-3"></div>
      <div class="col col-12 col-sm">

        <input type="submit" class="btn btn-primary px-4" value="{{ $film->exists ? 'Update' : 'Create' }}">

      </div>
    </div>


  </form>
@endsection