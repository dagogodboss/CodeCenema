<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/films'], function () {
  Route::get('/', ['as' => 'films', 'uses' => 'FilmsController@feed']);
  Route::get('create', ['as' => 'films.create', 'uses' => 'FilmsController@create']);
  Route::get('edit/{film}', ['as' => 'films.edit', 'uses' => 'FilmsController@edit']);
  Route::post('store', ['as' => 'films.store', 'uses' => 'FilmsController@store']);
  Route::get('{slug}', ['as' => 'films.show', 'uses' => 'FilmsController@show']);
});

Route::redirect('/', route('films'))->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  //comments
  Route::post('/comment/add', ['as' => 'comment.add', 'uses' => 'CommentsController@addComment']);
});