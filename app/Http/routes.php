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

function thumbcreate($video_field) {
    global $url;
    $video = str_replace("<iframe", "", $video_field);
    $start = '"http:';
    $end = '"';
    $path = '';
    if (preg_match_all('/' . preg_quote($start) . '(.*?)' . preg_quote($end) . '/', $video, $matches)) {
        $match_val = str_replace('"', '', $matches['0']['0']);
        $match_val_new = parse_url($match_val);
        isset($match_val_new['query']) ? parse_str($match_val_new['query'], $match) : '';
        $file = isset($match['file']) ? $match['file'] : '';
        if (file_exists('animethumb/' . $file . '.jpg')) {
            $path = $url . 'animethumb/' . $file . '.jpg';
        } else {
            $path = $url . 'css/imgs/no-image.jpg';
        }
    }
    return $path;
}

/*$router->get('/', function() {
    $episodes = DB::table('episodes')->get(['id', 'title']);
    foreach($episodes as $key => $episode) {
        DB::table('episodes')->where('id', $episode->id)->update([
            'slug' => str_slug($episode->title)
        ]);
    }
    echo 'Ya todos los episodios tienen slug';
});*/

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
