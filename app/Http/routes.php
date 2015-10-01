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

// Home routes...
$router->get('/', 'PageController@getHome');

// Authentication routes...
$router->get('login', 'Auth\AuthController@getLogin');
$router->post('login', 'Auth\AuthController@postLogin');
$router->get('logout', 'Auth\AuthController@getLogout');

// Social authentication routes...
$router->get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
$router->get('login/{provider}', 'Auth\AuthController@redirectToProvider');

// Registration routes...
$router->get('sign-up', 'Auth\AuthController@getRegister');
$router->post('sign-up', 'Auth\AuthController@postRegister');

// Password reset link request routes...
$router->get('password/email', 'Auth\PasswordController@getEmail');
$router->post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
$router->get('password/reset/{token}', 'Auth\PasswordController@getReset');
$router->post('password/reset', 'Auth\PasswordController@postReset');

// Anime routes...
$router->get('anime', 'AnimeController@getIndex');
$router->get('anime/{slug}', 'AnimeController@getBySlug');
$router->get('anime/latest', 'AnimeController@getLatest');
$router->get('anime/subbed', 'AnimeController@getSubbed');
$router->get('anime/subbed/{letter}', 'AnimeController@getSubbed');
$router->get('anime/dubbed', 'AnimeController@getDubbed');
$router->get('anime/dubbed/{letter}', 'AnimeController@getDubbed');
$router->get('anime/random', 'AnimeController@getRandom');
$router->get('anime/top', 'AnimeController@getTop');

// Episodes routes...
$router->get('episodes/latest', 'EpisodeController@getLatest');
$router->get('watch/{slug}/{mirror}', 'EpisodeController@getEpisodeMirror');
$router->get('watch/{slug}', 'EpisodeController@getEpisode');

// Search routes...
$router->get('browse', 'SearchController@index');
$router->get('search', 'SearchController@show');

// Rating routes...
$router->post('rate/anime', 'RateController@postAnime');
$router->post('rate/episode', 'RateController@postEpisode');

// Admin routes...
$router->group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function ($router) {
    $router->get('/', 'AdminController@index');

    // Animes routes...
    $router->get('animes', 'AnimeController@index');
    $router->get('animes/create', 'AnimeController@getCreate');
    $router->post('animes/create', 'AnimeController@postCreate');
    $router->get('animes/edit/{id}', 'AnimeController@getEdit');
    $router->post('animes/edit/{id}', 'AnimeController@postEdit');
    $router->post('animes/delete/{id}', 'AnimeController@postDelete');
    $router->get('animes/deleted', 'AnimeController@getDeleted');
    $router->post('animes/deleted/{id}', 'AnimeController@postDeleted');
    $router->post('animes/recover/{id}', 'AnimeController@postRecover');
    $router->get('animes/list', 'AnimeController@getList');
    $router->get('animes/list/deleted', 'AnimeController@getListDeleted');

    // Episodes routes...
    $router->get('episodes', 'EpisodeController@index');
    $router->get('episodes/create', 'EpisodeController@getCreate');
    $router->post('episodes/create', 'EpisodeController@postCreate');
    $router->get('episodes/edit/{id}', 'EpisodeController@getEdit');
    $router->post('episodes/edit/{id}', 'EpisodeController@postEdit');
    $router->post('episodes/delete/{id}', 'EpisodeController@postDelete');
    $router->get('episodes/deleted', 'EpisodeController@getDeleted');
    $router->post('episodes/deleted/{id}', 'EpisodeController@postDeleted');
    $router->post('episodes/recover/{id}', 'EpisodeController@postRecover');
    $router->get('episodes/list', 'EpisodeController@getList');
    $router->get('episodes/list/deleted', 'EpisodeController@getListDeleted');

    // Images routes...
    $router->get('images', 'ImageController@index');
    $router->get('images/create', 'ImageController@getCreate');
    $router->post('images/create', 'ImageController@postCreate');
    $router->get('images/edit/{id}', 'ImageController@getEdit');
    $router->post('images/edit/{id}', 'ImageController@postEdit');
    $router->post('images/delete/{id}', 'ImageController@postDelete');
    $router->get('images/deleted', 'ImageController@getDeleted');
    $router->post('images/deleted/{id}', 'ImageController@postDeleted');
    $router->post('images/recover/{id}', 'ImageController@postRecover');
    $router->get('images/list', 'ImageController@getList');
    $router->get('images/list/deleted', 'ImageController@getListDeleted');

    // Options routes...
    $router->get('options', 'OptionController@index');
    $router->get('options/create', 'OptionController@getCreate');
    $router->post('options/create', 'OptionController@postCreate');
    $router->get('options/edit/{id}', 'OptionController@getEdit');
    $router->post('options/edit/{id}', 'OptionController@postEdit');
    $router->post('options/delete/{id}', 'OptionController@postDelete');
    $router->get('options/deleted', 'OptionController@getDeleted');
    $router->post('options/deleted/{id}', 'OptionController@postDeleted');
    $router->post('options/recover/{id}', 'OptionController@postRecover');
    $router->get('options/list', 'OptionController@getList');
    $router->get('options/list/deleted', 'OptionController@getListDeleted');

    // Pages routes...
    $router->get('pages', 'PageController@index');
    $router->get('pages/create', 'PageController@getCreate');
    $router->post('pages/create', 'PageController@postCreate');
    $router->get('pages/edit/{id}', 'PageController@getEdit');
    $router->post('pages/edit/{id}', 'PageController@postEdit');
    $router->post('pages/delete/{id}', 'PageController@postDelete');
    $router->get('pages/deleted', 'PageController@getDeleted');
    $router->post('pages/deleted/{id}', 'PageController@postDeleted');
    $router->post('pages/recover/{id}', 'PageController@postRecover');
    $router->get('pages/list', 'PageController@getList');
    $router->get('pages/list/deleted', 'PageController@getListDeleted');

    // Users routes...
    $router->get('users', 'UserController@index');
    $router->get('users/create', 'UserController@getCreate');
    $router->post('users/create', 'UserController@postCreate');
    $router->get('users/edit/{id}', 'UserController@getEdit');
    $router->post('users/edit/{id}', 'UserController@postEdit');
    $router->post('users/delete/{id}', 'UserController@postDelete');
    $router->get('users/deleted', 'UserController@getDeleted');
    $router->post('users/deleted/{id}', 'UserController@postDeleted');
    $router->post('users/recover/{id}', 'UserController@postRecover');
    $router->get('users/list', 'UserController@getList');
    $router->get('users/list/deleted', 'UserController@getListDeleted');

    // Sitemap routes...
    $router->get('generate-sitemap', 'SitemapController@getGenerate');

    // Logs routes...
    $router->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
