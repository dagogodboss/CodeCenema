<?php

namespace App\Providers;

use App\Film;
use App\Image;
use App\Observers\FilmObserver;
use App\Observers\ImageObserver;
use App\Observers\UserObserver;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Image::observe(ImageObserver::class);
    Film::observe(FilmObserver::class);
    User::observe(UserObserver::class);

    Relation::morphMap([
      'film' => Film::class,
    ]);

    //set default pagination view
    LengthAwarePaginator::defaultView('pagination.bootstrap-4');
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    //
  }
}