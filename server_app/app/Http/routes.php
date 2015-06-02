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

// Route::get('/', 'WelcomeController@index');
// Route::get('home', 'HomeController@index');
// Route::get('contact', 'WelcomeController@contact');

// Route::get('about', 'PagesController@about');
Route::get('show', function()
{

    $article = ['id' => 1, 'title' => "today's dialy", 'content' => "It's a sunny day."];
    return Response::json($article);
});
Route::post('edit', function()
{
    $body = Input::all();
    if (empty($body)) {
        return App::abort(400);
    }
    return Response::json($body);
});

// Route::get('/', 'AggregateController@index');
// Route::get('aggregate', 'AggregateController@index');
// Route::get('aggregate/{id}', 'AggregateController@download');
// Route::post('aggregate', 'AggregateController@search');

// Route::resource('aggregate', 'AggregateController');
// Route::get('aggregate/test', 'AggregateController@test');

// Route::get('/', 'ArticlesController@index');  // root を記事一覧にします
Route::resource('articles', 'ArticlesController');

// Route::get('articles', 'ArticlesController@index');
// Route::get('articles/create', 'ArticlesController@create'); // ルートは記述順にマッチングされるため
// Route::get('articles/{id}', 'ArticlesController@show');
// Route::post('articles', 'ArticlesController@store');
// Route::get('articles/{id}/edit', 'ArticlesController@edit');
// Route::patch('articles/{id}', 'ArticlesController@update');
// Route::delete('articles/{id}', 'ArticlesController@destroy');

// Route::get('articles', ['as' => 'articles.index', 'uses' => 'ArticlesController@index']);
// Route::get('articles/create', ['as' => 'articles.create', 'uses' => 'ArticlesController@create']);
// Route::get('articles/{id}', ['as' => 'articles.show', 'uses' => 'ArticlesController@show']);
// Route::post('articles', ['as' => 'articles.store', 'uses' => 'ArticlesController@store']);
// Route::get('articles/{id}/edit', ['as' => 'articles.edit', 'uses' => 'ArticlesController@edit']);
// Route::patch('articles/{id}', ['as' => 'articles.update', 'uses' => 'ArticlesController@update']);
// Route::delete('articles/{id}', ['as' => 'articles.destroy', 'uses' => 'ArticlesController@destroy']);



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
