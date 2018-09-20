<?php

namespace App\Http\Controllers;

use App\Country;
use App\Film;
use App\Genre;
use Illuminate\Http\Request;

class FilmsController extends Controller {

  protected $perPage = 1;

  protected function feed() {

    $films = Film::latest('realease_date')
      ->withCount('comments')
      ->paginate($this->perPage);

    return view('films', [
      'films'   => $films,
      'title'   => __("Films Catalog"),
      'isLocal' => config('app.env') === 'local',
    ]);

  }

  public function create() {
    return view('film-add-edit', [
      'title'     => __("Create new Film"),
      'film'      => new Film(),
      'countries' => $this->countries(),
      'genres'    => $this->genres(),
    ]);
  }

  public function edit(Film $film) {
    return view('film-add-edit', [
      'title'     => __("Edit Film"),
      'film'      => $film,
      'countries' => $this->countries(),
      'genres'    => $this->genres(),
    ]);
  }

  private function countries() {
    return Country::orderBy('title')->get();
  }

  private function genres() {
    return Genre::orderBy('name')->get();
  }

  public function store(Request $request) {

    /** @var Film $film */
    $film = Film::findOrNew($request->input('id'));
    $isNew = !$film->exists;

    $photoRequiredRule = $film->photo ? 'nullable' : 'required';

    $this->validate($request, [
      'name'          => 'required|string',
      'description'   => 'required|string',
      'realease_date' => 'required|string|date',
      'country'       => 'required|integer|exists:countries,id',
      'genre'         => 'required|integer|exists:genres,id',
      'rating'        => 'required|integer|between:1,5',
      'ticket_price'  => 'required|numeric|min:0|max:99.99',
      'photo'         => "required|max:2048",
    ]);

    $film->name = $request->input('name');
    $film->slug = $film->generateSlug($film->name);
    $film->description = $request->input('description');
    $film->realease_date = $request->input('realease_date');
    $film->country_id = $request->input('country');
    $film->genre_id = $request->input('genre');
    $film->rating = $request->input('rating');
    $film->ticket_price = $request->input('ticket_price');
    $film->save();
    $this->uploadImage($film, 'photo');

    $successMessage = $isNew ? __("Film successfully created") : __("Film successfully updated");

    return redirect(route('home'))->with('success', $successMessage);
  }

  public function show(string $slug) {
    $film = Film::where('slug', '=', $slug)->firstOrFail();
    $comments = $film->comments()->oldest()->get();
    return view('film', [
      'title'    => $film->title(),
      'film'     => $film,
      'comments' => $comments,
    ]);
  }

}