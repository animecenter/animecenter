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

// Anime routes...
$router->get('anime-list', 'AnimeController@getAnimeList');
$router->get('latest-anime', 'AnimeController@getLatest');
$router->get('anime-list-dubbed', 'AnimeController@getDubbedAnimeList');
$router->get('browse_a-z-subbed', 'AnimeController@getBrowseSubbed');
$router->get('browse_a-z-dubbed', 'AnimeController@getBrowseDubbed');
$router->get('subbed-anime/{slug}', 'AnimeController@getSubbedAnime');
$router->get('dubbed-anime/{slug}', 'AnimeController@getDubbedAnime');

// Episodes routes...
$router->get('latest-episodes', 'EpisodeController@getLatest');
$router->get('watch/{slug}', 'EpisodeController@getEpisode');

// Genres routes...
$router->get('taxonomy_browser', 'GenreController@index');
