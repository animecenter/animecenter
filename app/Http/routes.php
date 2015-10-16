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
$router->get('anime/random', 'AnimeController@getRandom');
$router->get('anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}/{mirrorID}', 'AnimeController@getMirror');
$router->get('anime/watch/{animeSlug}/episode/{episodeNumber}/{translation}', 'AnimeController@getEpisode');
$router->get('anime/watch/{animeSlug}', 'AnimeController@getAnime');

// Episodes routes...
$router->get('episodes/latest', 'EpisodeController@getLatest');

// Search routes...
$router->get('explore', 'SearchController@index');
$router->get('search', 'SearchController@show');

// Rating routes...
$router->post('rate/anime', 'RateController@postAnime');
$router->post('rate/episode', 'RateController@postEpisode');

// Admin routes...
$router->group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function ($router) {
    $router->get('/', 'DashboardController@index');

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

    // Banners routes...
    $router->get('banners', 'BannerController@index');
    $router->get('banners/create', 'BannerController@getCreate');
    $router->post('banners/create', 'BannerController@postCreate');
    $router->get('banners/edit/{id}', 'BannerController@getEdit');
    $router->post('banners/edit/{id}', 'BannerController@postEdit');
    $router->post('banners/delete/{id}', 'BannerController@postDelete');
    $router->get('banners/deleted', 'BannerController@getDeleted');
    $router->post('banners/deleted/{id}', 'BannerController@postDeleted');
    $router->post('banners/recover/{id}', 'BannerController@postRecover');
    $router->get('banners/list', 'BannerController@getList');
    $router->get('banners/list/deleted', 'BannerController@getListDeleted');

    // Classifications routes...
    $router->get('classifications', 'ClassificationController@index');
    $router->get('classifications/create', 'ClassificationController@getCreate');
    $router->post('classifications/create', 'ClassificationController@postCreate');
    $router->get('classifications/edit/{id}', 'ClassificationController@getEdit');
    $router->post('classifications/edit/{id}', 'ClassificationController@postEdit');
    $router->post('classifications/delete/{id}', 'ClassificationController@postDelete');
    $router->get('classifications/deleted', 'ClassificationController@getDeleted');
    $router->post('classifications/deleted/{id}', 'ClassificationController@postDeleted');
    $router->post('classifications/recover/{id}', 'ClassificationController@postRecover');
    $router->get('classifications/list', 'ClassificationController@getList');
    $router->get('classifications/list/deleted', 'ClassificationController@getListDeleted');

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

    // Genres routes...
    $router->get('genres', 'GenreController@index');
    $router->get('genres/create', 'GenreController@getCreate');
    $router->post('genres/create', 'GenreController@postCreate');
    $router->get('genres/edit/{id}', 'GenreController@getEdit');
    $router->post('genres/edit/{id}', 'GenreController@postEdit');
    $router->post('genres/delete/{id}', 'GenreController@postDelete');
    $router->get('genres/deleted', 'GenreController@getDeleted');
    $router->post('genres/deleted/{id}', 'GenreController@postDeleted');
    $router->post('genres/recover/{id}', 'GenreController@postRecover');
    $router->get('genres/list', 'GenreController@getList');
    $router->get('genres/list/deleted', 'GenreController@getListDeleted');

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

    // Mirrors routes...
    $router->get('mirrors', 'MirrorController@index');
    $router->get('mirrors/create', 'MirrorController@getCreate');
    $router->post('mirrors/create', 'MirrorController@postCreate');
    $router->get('mirrors/edit/{id}', 'MirrorController@getEdit');
    $router->post('mirrors/edit/{id}', 'MirrorController@postEdit');
    $router->post('mirrors/delete/{id}', 'MirrorController@postDelete');
    $router->get('mirrors/deleted', 'MirrorController@getDeleted');
    $router->post('mirrors/deleted/{id}', 'MirrorController@postDeleted');
    $router->post('mirrors/recover/{id}', 'MirrorController@postRecover');
    $router->get('mirrors/list', 'MirrorController@getList');
    $router->get('mirrors/list/deleted', 'MirrorController@getListDeleted');

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

    // Producers routes...
    $router->get('producers', 'ProducerController@index');
    $router->get('producers/create', 'ProducerController@getCreate');
    $router->post('producers/create', 'ProducerController@postCreate');
    $router->get('producers/edit/{id}', 'ProducerController@getEdit');
    $router->post('producers/edit/{id}', 'ProducerController@postEdit');
    $router->post('producers/delete/{id}', 'ProducerController@postDelete');
    $router->get('producers/deleted', 'ProducerController@getDeleted');
    $router->post('producers/deleted/{id}', 'ProducerController@postDeleted');
    $router->post('producers/recover/{id}', 'ProducerController@postRecover');
    $router->get('producers/list', 'ProducerController@getList');
    $router->get('producers/list/deleted', 'ProducerController@getListDeleted');

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
