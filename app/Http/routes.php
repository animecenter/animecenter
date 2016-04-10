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
$router->get('search', 'SearchController@index');

// Rating routes...
$router->post('rate/anime', 'RateController@postRateAnime');
$router->post('rate/episode', 'RateController@postRateEpisode');

// Admin routes...
$router->group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function ($router) {
    $router->get('/', 'DashboardController@index');

    // Animes routes...
    $router->get('animes', 'AnimeController@index');
    $router->get('animes/create', 'AnimeController@getCreate');
    $router->post('animes/create', 'AnimeController@postCreate');
    $router->get('animes/edit/{id}', 'AnimeController@getEdit');
    $router->post('animes/edit/{id}', 'AnimeController@postEdit');
    $router->get('animes/trash', 'AnimeController@getTrash');
    $router->post('animes/trash/{id}', 'AnimeController@postTrash');
    $router->post('animes/delete/{id}', 'AnimeController@postDelete');
    $router->post('animes/recover/{id}', 'AnimeController@postRecover');
    $router->get('animes/list', 'AnimeController@getList');
    $router->get('animes/list/trash', 'AnimeController@getListTrash');

    // Banners routes...
    $router->get('banners', 'BannerController@index');
    $router->get('banners/create', 'BannerController@getCreate');
    $router->post('banners/create', 'BannerController@postCreate');
    $router->get('banners/edit/{id}', 'BannerController@getEdit');
    $router->post('banners/edit/{id}', 'BannerController@postEdit');
    $router->get('banners/trash', 'BannerController@getTrash');
    $router->post('banners/trash/{id}', 'BannerController@postTrash');
    $router->post('banners/delete/{id}', 'BannerController@postDelete');
    $router->post('banners/recover/{id}', 'BannerController@postRecover');
    $router->get('banners/list', 'BannerController@getList');
    $router->get('banners/list/trash', 'BannerController@getListTrash');

    // Calendar Seasons routes...
    $router->get('calendar-seasons', 'CalendarSeasonController@index');
    $router->get('calendar-seasons/create', 'CalendarSeasonController@getCreate');
    $router->post('calendar-seasons/create', 'CalendarSeasonController@postCreate');
    $router->get('calendar-seasons/edit/{id}', 'CalendarSeasonController@getEdit');
    $router->post('calendar-seasons/edit/{id}', 'CalendarSeasonController@postEdit');
    $router->get('calendar-seasons/trash', 'CalendarSeasonController@getTrash');
    $router->post('calendar-seasons/trash/{id}', 'CalendarSeasonController@postTrash');
    $router->post('calendar-seasons/delete/{id}', 'CalendarSeasonController@postDelete');
    $router->post('calendar-seasons/recover/{id}', 'CalendarSeasonController@postRecover');
    $router->get('calendar-seasons/list', 'CalendarSeasonController@getList');
    $router->get('calendar-seasons/list/trash', 'CalendarSeasonController@getListTrash');

    // Classifications routes...
    $router->get('classifications', 'ClassificationController@index');
    $router->get('classifications/create', 'ClassificationController@getCreate');
    $router->post('classifications/create', 'ClassificationController@postCreate');
    $router->get('classifications/edit/{id}', 'ClassificationController@getEdit');
    $router->post('classifications/edit/{id}', 'ClassificationController@postEdit');
    $router->get('classifications/trash', 'ClassificationController@getTrash');
    $router->post('classifications/trash/{id}', 'ClassificationController@postTrash');
    $router->post('classifications/delete/{id}', 'ClassificationController@postDelete');
    $router->post('classifications/recover/{id}', 'ClassificationController@postRecover');
    $router->get('classifications/list', 'ClassificationController@getList');
    $router->get('classifications/list/trash', 'ClassificationController@getListTrash');

    // Episodes routes...
    $router->get('episodes', 'EpisodeController@index');
    $router->get('episodes/create', 'EpisodeController@getCreate');
    $router->post('episodes/create', 'EpisodeController@postCreate');
    $router->get('episodes/edit/{id}', 'EpisodeController@getEdit');
    $router->post('episodes/edit/{id}', 'EpisodeController@postEdit');
    $router->get('episodes/trash', 'EpisodeController@getTrash');
    $router->post('episodes/trash/{id}', 'EpisodeController@postTrash');
    $router->post('episodes/delete/{id}', 'EpisodeController@postDelete');
    $router->post('episodes/recover/{id}', 'EpisodeController@postRecover');
    $router->get('episodes/list', 'EpisodeController@getList');
    $router->get('episodes/list/trash', 'EpisodeController@getListTrash');

    // Genres routes...
    $router->get('genres', 'GenreController@index');
    $router->get('genres/create', 'GenreController@getCreate');
    $router->post('genres/create', 'GenreController@postCreate');
    $router->get('genres/edit/{id}', 'GenreController@getEdit');
    $router->post('genres/edit/{id}', 'GenreController@postEdit');
    $router->get('genres/trash', 'GenreController@getTrash');
    $router->post('genres/trash/{id}', 'GenreController@postTrash');
    $router->post('genres/delete/{id}', 'GenreController@postDelete');
    $router->post('genres/recover/{id}', 'GenreController@postRecover');
    $router->get('genres/list', 'GenreController@getList');
    $router->get('genres/list/trash', 'GenreController@getListTrash');

    // Images routes...
    $router->get('images', 'ImageController@index');
    $router->get('images/create', 'ImageController@getCreate');
    $router->post('images/create', 'ImageController@postCreate');
    $router->get('images/edit/{id}', 'ImageController@getEdit');
    $router->post('images/edit/{id}', 'ImageController@postEdit');
    $router->get('images/trash', 'ImageController@getTrash');
    $router->post('images/trash/{id}', 'ImageController@postTrash');
    $router->post('images/delete/{id}', 'ImageController@postDelete');
    $router->post('images/recover/{id}', 'ImageController@postRecover');
    $router->get('images/list', 'ImageController@getList');
    $router->get('images/list/trash', 'ImageController@getListTrash');

    // Menus routes...
    $router->get('menus', 'MenuController@index');
    $router->get('menus/create', 'MenuController@getCreate');
    $router->post('menus/create', 'MenuController@postCreate');
    $router->get('menus/edit/{id}', 'MenuController@getEdit');
    $router->post('menus/edit/{id}', 'MenuController@postEdit');
    $router->get('menus/trash', 'MenuController@getTrash');
    $router->post('menus/trash/{id}', 'MenuController@postTrash');
    $router->post('menus/delete/{id}', 'MenuController@postDelete');
    $router->post('menus/recover/{id}', 'MenuController@postRecover');
    $router->get('menus/list', 'MenuController@getList');
    $router->get('menus/list/trash', 'MenuController@getListTrash');

    // Metas routes...
    $router->get('metas', 'MetaController@index');
    $router->get('metas/create', 'MetaController@getCreate');
    $router->post('metas/create', 'MetaController@postCreate');
    $router->get('metas/edit/{id}', 'MetaController@getEdit');
    $router->post('metas/edit/{id}', 'MetaController@postEdit');
    $router->get('metas/trash', 'MetaController@getTrash');
    $router->post('metas/trash/{id}', 'MetaController@postTrash');
    $router->post('metas/delete/{id}', 'MetaController@postDelete');
    $router->post('metas/recover/{id}', 'MetaController@postRecover');
    $router->get('metas/list', 'MetaController@getList');
    $router->get('metas/list/trash', 'MetaController@getListTrash');

    // Mirrors routes...
    $router->get('mirrors', 'MirrorController@index');
    $router->get('mirrors/create', 'MirrorController@getCreate');
    $router->post('mirrors/create', 'MirrorController@postCreate');
    $router->get('mirrors/edit/{id}', 'MirrorController@getEdit');
    $router->post('mirrors/edit/{id}', 'MirrorController@postEdit');
    $router->get('mirrors/trash', 'MirrorController@getTrash');
    $router->post('mirrors/trash/{id}', 'MirrorController@postTrash');
    $router->post('mirrors/delete/{id}', 'MirrorController@postDelete');
    $router->post('mirrors/recover/{id}', 'MirrorController@postRecover');
    $router->get('mirrors/list', 'MirrorController@getList');
    $router->get('mirrors/list/trash', 'MirrorController@getListTrash');

    // Mirror Reports routes...
    $router->get('mirror-reports', 'MirrorReportController@index');
    $router->get('mirror-reports/edit/{id}', 'MirrorReportController@getEdit');
    $router->post('mirror-reports/edit/{id}', 'MirrorReportController@postEdit');
    $router->get('mirror-reports/trash', 'MirrorReportController@getTrash');
    $router->post('mirror-reports/trash/{id}', 'MirrorReportController@postTrash');
    $router->post('mirror-reports/delete/{id}', 'MirrorReportController@postDelete');
    $router->post('mirror-reports/recover/{id}', 'MirrorReportController@postRecover');
    $router->get('mirror-reports/list', 'MirrorReportController@getList');
    $router->get('mirror-reports/list/trash', 'MirrorReportController@getListTrash');

    // Mirror Sources routes...
    $router->get('mirror-sources', 'MirrorSourceController@index');
    $router->get('mirror-sources/create', 'MirrorSourceController@getCreate');
    $router->post('mirror-sources/create', 'MirrorSourceController@postCreate');
    $router->get('mirror-sources/edit/{id}', 'MirrorSourceController@getEdit');
    $router->post('mirror-sources/edit/{id}', 'MirrorSourceController@postEdit');
    $router->get('mirror-sources/trash', 'MirrorSourceController@getTrash');
    $router->post('mirror-sources/trash/{id}', 'MirrorSourceController@postTrash');
    $router->post('mirror-sources/delete/{id}', 'MirrorSourceController@postDelete');
    $router->post('mirror-sources/recover/{id}', 'MirrorSourceController@postRecover');
    $router->get('mirror-sources/list', 'MirrorSourceController@getList');
    $router->get('mirror-sources/list/trash', 'MirrorSourceController@getListTrash');

    // Options routes...
    $router->get('options', 'OptionController@index');
    $router->get('options/create', 'OptionController@getCreate');
    $router->post('options/create', 'OptionController@postCreate');
    $router->get('options/edit/{id}', 'OptionController@getEdit');
    $router->post('options/edit/{id}', 'OptionController@postEdit');
    $router->get('options/trash', 'OptionController@getTrash');
    $router->post('options/trash/{id}', 'OptionController@postTrash');
    $router->post('options/delete/{id}', 'OptionController@postDelete');
    $router->post('options/recover/{id}', 'OptionController@postRecover');
    $router->get('options/list', 'OptionController@getList');
    $router->get('options/list/trash', 'OptionController@getListTrash');

    // Pages routes...
    $router->get('pages', 'PageController@index');
    $router->get('pages/create', 'PageController@getCreate');
    $router->post('pages/create', 'PageController@postCreate');
    $router->get('pages/edit/{id}', 'PageController@getEdit');
    $router->post('pages/edit/{id}', 'PageController@postEdit');
    $router->get('pages/trash', 'PageController@getTrash');
    $router->post('pages/trash/{id}', 'PageController@postTrash');
    $router->post('pages/delete/{id}', 'PageController@postDelete');
    $router->post('pages/recover/{id}', 'PageController@postRecover');
    $router->get('pages/list', 'PageController@getList');
    $router->get('pages/list/trash', 'PageController@getListTrash');

    // Permissions routes...
    $router->get('permissions', 'PermissionController@index');
    $router->get('permissions/create', 'PermissionController@getCreate');
    $router->post('permissions/create', 'PermissionController@postCreate');
    $router->get('permissions/edit/{id}', 'PermissionController@getEdit');
    $router->post('permissions/edit/{id}', 'PermissionController@postEdit');
    $router->get('permissions/trash', 'PermissionController@getTrash');
    $router->post('permissions/trash/{id}', 'PermissionController@postTrash');
    $router->post('permissions/delete/{id}', 'PermissionController@postDelete');
    $router->post('permissions/recover/{id}', 'PermissionController@postRecover');
    $router->get('permissions/list', 'PermissionController@getList');
    $router->get('permissions/list/trash', 'PermissionController@getListTrash');

    // Producers routes...
    $router->get('producers', 'ProducerController@index');
    $router->get('producers/create', 'ProducerController@getCreate');
    $router->post('producers/create', 'ProducerController@postCreate');
    $router->get('producers/edit/{id}', 'ProducerController@getEdit');
    $router->post('producers/edit/{id}', 'ProducerController@postEdit');
    $router->get('producers/trash', 'ProducerController@getTrash');
    $router->post('producers/trash/{id}', 'ProducerController@postTrash');
    $router->post('producers/delete/{id}', 'ProducerController@postDelete');
    $router->post('producers/recover/{id}', 'ProducerController@postRecover');
    $router->get('producers/list', 'ProducerController@getList');
    $router->get('producers/list/trash', 'ProducerController@getListTrash');

    // Relations routes...
    $router->get('relations', 'RelationController@index');
    $router->get('relations/create', 'RelationController@getCreate');
    $router->post('relations/create', 'RelationController@postCreate');
    $router->get('relations/edit/{id}', 'RelationController@getEdit');
    $router->post('relations/edit/{id}', 'RelationController@postEdit');
    $router->get('relations/trash', 'RelationController@getTrash');
    $router->post('relations/trash/{id}', 'RelationController@postTrash');
    $router->post('relations/delete/{id}', 'RelationController@postDelete');
    $router->post('relations/recover/{id}', 'RelationController@postRecover');
    $router->get('relations/list', 'RelationController@getList');
    $router->get('relations/list/trash', 'RelationController@getListTrash');

    // Relationships routes...
    $router->get('relationships', 'RelationshipController@index');
    $router->get('relationships/create', 'RelationshipController@getCreate');
    $router->post('relationships/create', 'RelationshipController@postCreate');
    $router->get('relationships/edit/{id}', 'RelationshipController@getEdit');
    $router->post('relationships/edit/{id}', 'RelationshipController@postEdit');
    $router->get('relationships/trash', 'RelationshipController@getTrash');
    $router->post('relationships/trash/{id}', 'RelationshipController@postTrash');
    $router->post('relationships/delete/{id}', 'RelationshipController@postDelete');
    $router->post('relationships/recover/{id}', 'RelationshipController@postRecover');
    $router->get('relationships/list', 'RelationshipController@getList');
    $router->get('relationships/list/trash', 'RelationshipController@getListTrash');

    // Roles routes...
    $router->get('roles', 'RoleController@index');
    $router->get('roles/create', 'RoleController@getCreate');
    $router->post('roles/create', 'RoleController@postCreate');
    $router->get('roles/edit/{id}', 'RoleController@getEdit');
    $router->post('roles/edit/{id}', 'RoleController@postEdit');
    $router->get('roles/trash', 'RoleController@getTrash');
    $router->post('roles/trash/{id}', 'RoleController@postTrash');
    $router->post('roles/delete/{id}', 'RoleController@postDelete');
    $router->post('roles/recover/{id}', 'RoleController@postRecover');
    $router->get('roles/list', 'RoleController@getList');
    $router->get('roles/list/trash', 'RoleController@getListTrash');

    // Statuses routes...
    $router->get('statuses', 'StatusController@index');
    $router->get('statuses/create', 'StatusController@getCreate');
    $router->post('statuses/create', 'StatusController@postCreate');
    $router->get('statuses/edit/{id}', 'StatusController@getEdit');
    $router->post('statuses/edit/{id}', 'StatusController@postEdit');
    $router->get('statuses/trash', 'StatusController@getTrash');
    $router->post('statuses/trash/{id}', 'StatusController@postTrash');
    $router->post('statuses/delete/{id}', 'StatusController@postDelete');
    $router->post('statuses/recover/{id}', 'StatusController@postRecover');
    $router->get('statuses/list', 'StatusController@getList');
    $router->get('statuses/list/trash', 'StatusController@getListTrash');

    // Titles routes...
    $router->get('titles', 'TitleController@index');
    $router->get('titles/create', 'TitleController@getCreate');
    $router->post('titles/create', 'TitleController@postCreate');
    $router->get('titles/edit/{id}', 'TitleController@getEdit');
    $router->post('titles/edit/{id}', 'TitleController@postEdit');
    $router->get('titles/trash', 'TitleController@getTrash');
    $router->post('titles/trash/{id}', 'TitleController@postTrash');
    $router->post('titles/delete/{id}', 'TitleController@postDelete');
    $router->post('titles/recover/{id}', 'TitleController@postRecover');
    $router->get('titles/list', 'TitleController@getList');
    $router->get('titles/list/trash', 'TitleController@getListTrash');

    // Types routes...
    $router->get('types', 'TypeController@index');
    $router->get('types/create', 'TypeController@getCreate');
    $router->post('types/create', 'TypeController@postCreate');
    $router->get('types/edit/{id}', 'TypeController@getEdit');
    $router->post('types/edit/{id}', 'TypeController@postEdit');
    $router->get('types/trash', 'TypeController@getTrash');
    $router->post('types/trash/{id}', 'TypeController@postTrash');
    $router->post('types/delete/{id}', 'TypeController@postDelete');
    $router->post('types/recover/{id}', 'TypeController@postRecover');
    $router->get('types/list', 'TypeController@getList');
    $router->get('types/list/trash', 'TypeController@getListTrash');

    // Users routes...
    $router->get('users', 'UserController@index');
    $router->get('users/create', 'UserController@getCreate');
    $router->post('users/create', 'UserController@postCreate');
    $router->get('users/edit/{id}', 'UserController@getEdit');
    $router->post('users/edit/{id}', 'UserController@postEdit');
    $router->get('users/trash', 'UserController@getTrash');
    $router->post('users/trash/{id}', 'UserController@postTrash');
    $router->post('users/delete/{id}', 'UserController@postDelete');
    $router->post('users/recover/{id}', 'UserController@postRecover');
    $router->get('users/list', 'UserController@getList');
    $router->get('users/list/trash', 'UserController@getListTrash');

    // Sitemap routes...
    $router->get('generate-sitemap', 'SitemapController@getGenerate');

    // Logs routes...
    $router->get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
