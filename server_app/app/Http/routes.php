<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('contact', 'WelcomeController@contact');

Route::get('about', 'PagesController@about');

Route::get('articles', 'ArticlesController@index');
Route::get('articles/create', 'ArticlesController@create'); // ルートは記述順にマッチングされるため
Route::get('articles/{id}', 'ArticlesController@show');
Route::post('articles', 'ArticlesController@store');
Route::get('articles/{id}/edit', 'ArticlesController@edit');
Route::patch('articles/{id}', 'ArticlesController@update');
Route::delete('articles/{id}', 'ArticlesController@destroy');

// Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
