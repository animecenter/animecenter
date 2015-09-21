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
$router->get('/', 'HomeController@index');

// Authentication routes...
$router->get('/login', 'Auth\AuthController@getLogin');
$router->post('/login', 'Auth\AuthController@postLogin');
$router->get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
$router->get('/register', 'Auth\AuthController@getRegister');
$router->post('/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
$router->get('/password/email', 'Auth\PasswordController@getEmail');
$router->post('/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
$router->get('/password/reset/{token}', 'Auth\PasswordController@getReset');
$router->post('/password/reset', 'Auth\PasswordController@postReset');

// Anime routes...
$router->get('/latest-anime', 'AnimeController@getLatest');
$router->get('/anime-list', 'AnimeController@getSubbedAnimeList');
$router->get('/anime-list/{letter}', 'AnimeController@getSubbedAnimeList');
$router->get('/anime-list-dubbed', 'AnimeController@getDubbedAnimeList');
$router->get('/anime-list-dubbed/{letter}', 'AnimeController@getDubbedAnimeList');
$router->get('/browse_a-z-subbed', 'AnimeController@getBrowseSubbed');
$router->get('/browse_a-z-subbed/{letter}', 'AnimeController@getBrowseSubbed');
$router->get('/browse_a-z-dubbed', 'AnimeController@getBrowseDubbed');
$router->get('/browse_a-z-dubbed/{letter}', 'AnimeController@getBrowseDubbed');
$router->get('/subbed-anime/{slug}', 'AnimeController@getSubbedAnime');
$router->get('/dubbed-anime/{slug}', 'AnimeController@getDubbedAnime');

// Episodes routes...
$router->get('/latest-episodes', 'EpisodeController@getLatest');
$router->get('/watch/{slug}/{mirror}', 'EpisodeController@getEpisodeMirror');
$router->get('/watch/{slug}', 'EpisodeController@getEpisode');

// Genres routes...
$router->get('/taxonomy_browser', 'GenreController@index');

// Search routes...
$router->get('/search', 'SearchController@index');

// Rating routes...
$router->post('/rate/anime', 'RateController@postAnime');
$router->post('/rate/episode', 'RateController@postEpisode');

// Admin routes...
$router->group([
    'prefix' => '/admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'
], function($router) {
    $router->get('/', 'AdminController@index');

    // Admin anime routes...
    $router->get('/anime', 'AnimeController@index');
    $router->get('/anime/create', 'AnimeController@getCreate');
    $router->post('/anime/create', 'AnimeController@postCreate');
    $router->get('/anime/edit/{id}', 'AnimeController@getEdit');
    $router->post('/anime/edit/{id}', 'AnimeController@postEdit');
    $router->get('/anime/delete/{id}', 'AnimeController@getDelete');

    // Admin episodes routes...
    $router->get('/episodes', 'EpisodeController@index');
    $router->get('/episodes/create', 'EpisodeController@getCreate');
    $router->get('/episodes/create/{id}', 'EpisodeController@getCreateByAnimeID');
    $router->post('/episodes/create', 'EpisodeController@postCreate');
    $router->post('/episodes/create/automatically', 'EpisodeController@postCreateAutomatically');
    $router->get('/episodes/edit/{id}', 'EpisodeController@getEdit');
    $router->post('/episodes/edit/{id}', 'EpisodeController@postEdit');
    $router->get('/episodes/delete/{id}', 'EpisodeController@getDelete');

    // Admin pages routes...
    $router->get('/pages', 'PageController@index');
    $router->get('/pages/create', 'PageController@getCreate');
    $router->post('/pages/create', 'PageController@postCreate');
    $router->get('/pages/edit/{id}', 'PageController@getEdit');
    $router->post('/pages/edit/{id}', 'PageController@postEdit');
    $router->get('/pages/delete/{id}', 'PageController@getDelete');

    // Admin images routes...
    $router->get('/images', 'ImageController@index');
    $router->get('/images/create', 'ImageController@getCreate');
    $router->post('/images/create', 'ImageController@postCreate');
    $router->get('/images/edit/{id}', 'ImageController@getEdit');
    $router->post('/images/edit/{id}', 'ImageController@postEdit');
    $router->get('/images/delete/{id}', 'ImageController@getDelete');

    // Admin options routes...
    $router->get('/options/edit', 'OptionController@getEdit');
    $router->post('/options/edit', 'OptionController@postEdit');

    // Admin cache routes...
    $router->get('/purge-cache', 'CacheController@getPurge');

    // Sitemap routes...
    $router->get('/generate-sitemap', 'SitemapController@getGenerate');
});
