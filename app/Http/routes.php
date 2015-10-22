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
    $router->get('{animes}', 'AnimeController@index');
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
    $router->get('{banners}', 'BannerController@index');
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

    // Calendar Seasons routes...
    $router->get('{calendar-seasons}', 'CalendarSeasonController@index');
    $router->get('calendar-seasons/create', 'CalendarSeasonController@getCreate');
    $router->post('calendar-seasons/create', 'CalendarSeasonController@postCreate');
    $router->get('calendar-seasons/edit/{id}', 'CalendarSeasonController@getEdit');
    $router->post('calendar-seasons/edit/{id}', 'CalendarSeasonController@postEdit');
    $router->post('calendar-seasons/delete/{id}', 'CalendarSeasonController@postDelete');
    $router->get('calendar-seasons/deleted', 'CalendarSeasonController@getDeleted');
    $router->post('calendar-seasons/deleted/{id}', 'CalendarSeasonController@postDeleted');
    $router->post('calendar-seasons/recover/{id}', 'CalendarSeasonController@postRecover');
    $router->get('calendar-seasons/list', 'CalendarSeasonController@getList');
    $router->get('calendar-seasons/list/deleted', 'CalendarSeasonController@getListDeleted');

    // Classifications routes...
    $router->get('{classifications}', 'ClassificationController@index');
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
    $router->get('{episodes}', 'EpisodeController@index');
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
    $router->get('{genres}', 'GenreController@index');
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
    $router->get('{images}', 'ImageController@index');
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

    // Menus routes...
    $router->get('{menus}', 'MenuController@index');
    $router->get('menus/create', 'MenuController@getCreate');
    $router->post('menus/create', 'MenuController@postCreate');
    $router->get('menus/edit/{id}', 'MenuController@getEdit');
    $router->post('menus/edit/{id}', 'MenuController@postEdit');
    $router->post('menus/delete/{id}', 'MenuController@postDelete');
    $router->get('menus/deleted', 'MenuController@getDeleted');
    $router->post('menus/deleted/{id}', 'MenuController@postDeleted');
    $router->post('menus/recover/{id}', 'MenuController@postRecover');
    $router->get('menus/list', 'MenuController@getList');
    $router->get('menus/list/deleted', 'MenuController@getListDeleted');

    // Metas routes...
    $router->get('{metas}', 'MetaController@index');
    $router->get('metas/create', 'MetaController@getCreate');
    $router->post('metas/create', 'MetaController@postCreate');
    $router->get('metas/edit/{id}', 'MetaController@getEdit');
    $router->post('metas/edit/{id}', 'MetaController@postEdit');
    $router->post('metas/delete/{id}', 'MetaController@postDelete');
    $router->get('metas/deleted', 'MetaController@getDeleted');
    $router->post('metas/deleted/{id}', 'MetaController@postDeleted');
    $router->post('metas/recover/{id}', 'MetaController@postRecover');
    $router->get('metas/list', 'MetaController@getList');
    $router->get('metas/list/deleted', 'MetaController@getListDeleted');

    // Mirrors routes...
    $router->get('{mirrors}', 'MirrorController@index');
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

    // Mirror Reports routes...
    $router->get('{mirror-reports}', 'MirrorReportController@index');
    $router->get('mirror-reports/create', 'MirrorReportController@getCreate');
    $router->post('mirror-reports/create', 'MirrorReportController@postCreate');
    $router->get('mirror-reports/edit/{id}', 'MirrorReportController@getEdit');
    $router->post('mirror-reports/edit/{id}', 'MirrorReportController@postEdit');
    $router->post('mirror-reports/delete/{id}', 'MirrorReportController@postDelete');
    $router->get('mirror-reports/deleted', 'MirrorReportController@getDeleted');
    $router->post('mirror-reports/deleted/{id}', 'MirrorReportController@postDeleted');
    $router->post('mirror-reports/recover/{id}', 'MirrorReportController@postRecover');
    $router->get('mirror-reports/list', 'MirrorReportController@getList');
    $router->get('mirror-reports/list/deleted', 'MirrorReportController@getListDeleted');

    // Mirror Sources routes...
    $router->get('{mirror-sources}', 'MirrorSourceController@index');
    $router->get('mirror-sources/create', 'MirrorSourceController@getCreate');
    $router->post('mirror-sources/create', 'MirrorSourceController@postCreate');
    $router->get('mirror-sources/edit/{id}', 'MirrorSourceController@getEdit');
    $router->post('mirror-sources/edit/{id}', 'MirrorSourceController@postEdit');
    $router->post('mirror-sources/delete/{id}', 'MirrorSourceController@postDelete');
    $router->get('mirror-sources/deleted', 'MirrorSourceController@getDeleted');
    $router->post('mirror-sources/deleted/{id}', 'MirrorSourceController@postDeleted');
    $router->post('mirror-sources/recover/{id}', 'MirrorSourceController@postRecover');
    $router->get('mirror-sources/list', 'MirrorSourceController@getList');
    $router->get('mirror-sources/list/deleted', 'MirrorSourceController@getListDeleted');

    // Options routes...
    $router->get('{options}', 'OptionController@index');
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
    $router->get('{pages}', 'PageController@index');
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

    // Permissions routes...
    $router->get('{permissions}', 'PermissionController@index');
    $router->get('permissions/create', 'PermissionController@getCreate');
    $router->post('permissions/create', 'PermissionController@postCreate');
    $router->get('permissions/edit/{id}', 'PermissionController@getEdit');
    $router->post('permissions/edit/{id}', 'PermissionController@postEdit');
    $router->post('permissions/delete/{id}', 'PermissionController@postDelete');
    $router->get('permissions/deleted', 'PermissionController@getDeleted');
    $router->post('permissions/deleted/{id}', 'PermissionController@postDeleted');
    $router->post('permissions/recover/{id}', 'PermissionController@postRecover');
    $router->get('permissions/list', 'PermissionController@getList');
    $router->get('permissions/list/deleted', 'PermissionController@getListDeleted');

    // Producers routes...
    $router->get('{producers}', 'ProducerController@index');
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

    // Relations routes...
    $router->get('{relations}', 'RelationController@index');
    $router->get('relations/create', 'RelationController@getCreate');
    $router->post('relations/create', 'RelationController@postCreate');
    $router->get('relations/edit/{id}', 'RelationController@getEdit');
    $router->post('relations/edit/{id}', 'RelationController@postEdit');
    $router->post('relations/delete/{id}', 'RelationController@postDelete');
    $router->get('relations/deleted', 'RelationController@getDeleted');
    $router->post('relations/deleted/{id}', 'RelationController@postDeleted');
    $router->post('relations/recover/{id}', 'RelationController@postRecover');
    $router->get('relations/list', 'RelationController@getList');
    $router->get('relations/list/deleted', 'RelationController@getListDeleted');

    // Relationships routes...
    $router->get('{relationships}', 'RelationshipController@index');
    $router->get('relationships/create', 'RelationshipController@getCreate');
    $router->post('relationships/create', 'RelationshipController@postCreate');
    $router->get('relationships/edit/{id}', 'RelationshipController@getEdit');
    $router->post('relationships/edit/{id}', 'RelationshipController@postEdit');
    $router->post('relationships/delete/{id}', 'RelationshipController@postDelete');
    $router->get('relationships/deleted', 'RelationshipController@getDeleted');
    $router->post('relationships/deleted/{id}', 'RelationshipController@postDeleted');
    $router->post('relationships/recover/{id}', 'RelationshipController@postRecover');
    $router->get('relationships/list', 'RelationshipController@getList');
    $router->get('relationships/list/deleted', 'RelationshipController@getListDeleted');

    // Roles routes...
    $router->get('{roles}', 'RoleController@index');
    $router->get('roles/create', 'RoleController@getCreate');
    $router->post('roles/create', 'RoleController@postCreate');
    $router->get('roles/edit/{id}', 'RoleController@getEdit');
    $router->post('roles/edit/{id}', 'RoleController@postEdit');
    $router->post('roles/delete/{id}', 'RoleController@postDelete');
    $router->get('roles/deleted', 'RoleController@getDeleted');
    $router->post('roles/deleted/{id}', 'RoleController@postDeleted');
    $router->post('roles/recover/{id}', 'RoleController@postRecover');
    $router->get('roles/list', 'RoleController@getList');
    $router->get('roles/list/deleted', 'RoleController@getListDeleted');

    // Statuses routes...
    $router->get('{statuses}', 'StatusController@index');
    $router->get('statuses/create', 'StatusController@getCreate');
    $router->post('statuses/create', 'StatusController@postCreate');
    $router->get('statuses/edit/{id}', 'StatusController@getEdit');
    $router->post('statuses/edit/{id}', 'StatusController@postEdit');
    $router->post('statuses/delete/{id}', 'StatusController@postDelete');
    $router->get('statuses/deleted', 'StatusController@getDeleted');
    $router->post('statuses/deleted/{id}', 'StatusController@postDeleted');
    $router->post('statuses/recover/{id}', 'StatusController@postRecover');
    $router->get('statuses/list', 'StatusController@getList');
    $router->get('statuses/list/deleted', 'StatusController@getListDeleted');

    // Titles routes...
    $router->get('{titles}', 'TitleController@index');
    $router->get('titles/create', 'TitleController@getCreate');
    $router->post('titles/create', 'TitleController@postCreate');
    $router->get('titles/edit/{id}', 'TitleController@getEdit');
    $router->post('titles/edit/{id}', 'TitleController@postEdit');
    $router->post('titles/delete/{id}', 'TitleController@postDelete');
    $router->get('titles/deleted', 'TitleController@getDeleted');
    $router->post('titles/deleted/{id}', 'TitleController@postDeleted');
    $router->post('titles/recover/{id}', 'TitleController@postRecover');
    $router->get('titles/list', 'TitleController@getList');
    $router->get('titles/list/deleted', 'TitleController@getListDeleted');

    // Types routes...
    $router->get('{types}', 'TypeController@index');
    $router->get('types/create', 'TypeController@getCreate');
    $router->post('types/create', 'TypeController@postCreate');
    $router->get('types/edit/{id}', 'TypeController@getEdit');
    $router->post('types/edit/{id}', 'TypeController@postEdit');
    $router->post('types/delete/{id}', 'TypeController@postDelete');
    $router->get('types/deleted', 'TypeController@getDeleted');
    $router->post('types/deleted/{id}', 'TypeController@postDeleted');
    $router->post('types/recover/{id}', 'TypeController@postRecover');
    $router->get('types/list', 'TypeController@getList');
    $router->get('types/list/deleted', 'TypeController@getListDeleted');

    // Users routes...
    $router->get('{users}', 'UserController@index');
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
