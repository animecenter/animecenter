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


use App\Users\User;
use Illuminate\Database\Schema\Blueprint;
$router->get('update-db', function() {
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '2048M');

    // Update Users
    Schema::dropIfExists('an_users');
    Schema::create('users', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('username', 191)->unique();
        $table->string('email', 191)->unique();
        $table->string('password', 60);
        $table->rememberToken();
        $table->timestamps();
        $table->softDeletes();
    });
    User::create([
        'username' => 'daiky',
        'email' => 'project.01@hotmail.com',
        'password' => Hash::make('esinseguro')
    ]);
    Schema::create('password_resets', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->string('email')->index();
        $table->string('token')->index();
        $table->timestamp('created_at');
    });

    // Update Anime
    Schema::rename("an_series", "animes");
    Schema::table('animes', function ($table) {
        $table->renameColumn('a_id', 'id');
        $table->renameColumn('a_title', 'title');
        $table->string('slug', 255)->unique();
        $table->renameColumn('a_content', 'content');
        $table->renameColumn('a_genres', 'genres');
        $table->renameColumn('a_episodes', 'episodes');
        $table->renameColumn('a_type', 'type');
        $table->renameColumn('a_age', 'age');
        $table->renameColumn('a_type2', 'type2');
        $table->renameColumn('a_status', 'status');
        $table->renameColumn('a_prequel', 'prequel');
        $table->renameColumn('a_sequel', 'sequel');
        $table->renameColumn('a_story', 'story');
        $table->renameColumn('a_side_story', 'side_story');
        $table->renameColumn('a_spin_off', 'spin_off');
        $table->renameColumn('a_alternative', 'alternative');
        $table->renameColumn('a_other', 'other');
        $table->renameColumn('a_position', 'position');
        $table->renameColumn('a_description', 'description');
        $table->renameColumn('a_alternative_title', 'alternative_title');
        $table->renameColumn('a_image', 'image');
        $table->renameColumn('a_rating', 'rating');
        $table->renameColumn('a_votes', 'votes');
        $table->renameColumn('a_visits', 'visits');
        $table->renameColumn('a_date', 'date');
        $table->renameColumn('a_date2', 'date2');
    });
    $animes = DB::table('animes')->get(['id', 'title']);
    foreach($animes as $anime) {
        DB::table('animes')->where('id', $anime->id)->update([
            'slug' => str_slug($anime->title)
        ]);
    }
    echo 'All anime have a slug now';

    // Update Episodes
    Schema::rename("an_episodes", "episodes");
    Schema::table('episodes', function ($table) {
        $table->renameColumn('e_id', 'id');
        $table->renameColumn('e_title', 'title');
        $table->string('slug', 255)->unique();
        $table->renameColumn('e_subdub', 'subdub');
        $table->renameColumn('e_not_yeird', 'not_yet_aired');
        $table->renameColumn('e_raw', 'raw');
        $table->renameColumn('e_hd', 'hd');
        $table->renameColumn('e_mirror1', 'mirror1');
        $table->renameColumn('e_mirror2', 'mirror2');
        $table->renameColumn('e_mirror3', 'mirror3');
        $table->renameColumn('e_mirror4', 'mirror4');
        $table->renameColumn('e_series', 'anime_id');
        $table->renameColumn('e_date', 'date');
        $table->renameColumn('e_date2', 'date2');
        $table->renameColumn('e_rating', 'rating');
        $table->renameColumn('e_votes', 'votes');
        $table->renameColumn('e_visits', 'visits');
        $table->renameColumn('e_order', 'order');
        $table->renameColumn('e_coming_date', 'coming_date');
        $table->foreign('anime_id')->references('id')->on('animes')
            ->onDelete('cascade')
            ->onUpdate('cascade');
    });
    $episodes = DB::table('episodes')->get(['id', 'title']);
    foreach($episodes as $episode) {
        DB::table('episodes')->where('id', $episode->id)->update([
            'slug' => str_slug($episode->title)
        ]);
    }
    echo 'All episodes have a slug now';

    // Update Pages
    Schema::rename("an_pages", "pages");
    Schema::table('pages', function ($table) {
        $table->renameColumn('p_id', 'id');
        $table->renameColumn('p_title', 'title');
        $table->renameColumn('p_content', 'content');
        $table->renameColumn('p_link', 'link');
        $table->renameColumn('p_order', 'order');
        $table->renameColumn('p_position', 'position');
    });
    $pages = DB::table('pages')->get(['id', 'link']);
    foreach($pages as $page) {
        if (strpos($page->link, 'hunter-x-hunter-2011-') !== false) {
            DB::table('pages')->where('id', $page->id)->update([
                'link' => '/subbed-anime/hunter-x-hunter-2011'
            ]);
        } else {
            DB::table('pages')->where('id', $page->id)->update([
                'link' => str_replace('http://www.animecenter.tv', '',
                    str_replace('http://animecenter.tv', '', strtolower($page->link)))
            ]);
        }
    }
    echo 'All pages were updated';

    // Update Genres
    Schema::rename("an_genres", "genres");
    Schema::table('genres', function ($table) {
        $table->renameColumn('o_id', 'id');
        $table->renameColumn('o_value', 'value');
    });
    echo 'All genres were updated';

    // Update Options
    Schema::rename("an_options", "options");
    Schema::table('options', function ($table) {
        $table->renameColumn('g_id', 'id');
        $table->renameColumn('g_value', 'value');
    });
    echo 'All options were updated';

    // Update Images
    Schema::rename("an_images", "images");
    Schema::table('images', function ($table) {
        $table->renameColumn('i_id', 'id');
        $table->renameColumn('i_bigtitle', 'bigtitle');
        $table->renameColumn('i_smalltitle', 'smalltitle');
        $table->renameColumn('i_desc', 'desc');
        $table->renameColumn('i_file', 'file');
        $table->renameColumn('i_link', 'link');
        $table->renameColumn('i_date', 'date');
    });
    echo 'All images were updated';
});

// Home routes...
$router->get('/', 'HomeController@index');

// Authentication routes...
$router->get('login', 'Auth\AuthController@getLogin');
$router->post('login', 'Auth\AuthController@postLogin');
$router->get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
$router->get('register', 'Auth\AuthController@getRegister');
$router->post('register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
$router->get('password/email', 'Auth\PasswordController@getEmail');
$router->post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
$router->get('password/reset/{token}', 'Auth\PasswordController@getReset');
$router->post('password/reset', 'Auth\PasswordController@postReset');

// Anime routes...
$router->get('latest-anime', 'AnimeController@getLatest');
$router->get('anime-list', 'AnimeController@getSubbedAnimeList');
$router->get('anime-list/{letter}', 'AnimeController@getSubbedAnimeList');
$router->get('anime-list-dubbed', 'AnimeController@getDubbedAnimeList');
$router->get('anime-list-dubbed/{letter}', 'AnimeController@getDubbedAnimeList');
$router->get('browse_a-z-subbed', 'AnimeController@getBrowseSubbed');
$router->get('browse_a-z-subbed/{letter}', 'AnimeController@getBrowseSubbed');
$router->get('browse_a-z-dubbed', 'AnimeController@getBrowseDubbed');
$router->get('browse_a-z-dubbed/{letter}', 'AnimeController@getBrowseDubbed');
$router->get('subbed-anime/{slug}', 'AnimeController@getSubbedAnime');
$router->get('dubbed-anime/{slug}', 'AnimeController@getDubbedAnime');

// Episodes routes...
$router->get('latest-episodes', 'EpisodeController@getLatest');
$router->get('watch/{slug}', 'EpisodeController@getEpisode');

// Genres routes...
$router->get('taxonomy_browser', 'GenreController@index');

// Search routes...
$router->get('search', 'SearchController@index');

// Admin routes...
$router->group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'
], function($router) {
    $router->get('/', 'AdminController@index');

    // Admin anime routes...
    $router->get('anime', 'AnimeController@index');
    $router->get('anime/create', 'AnimeController@getCreate');
    $router->post('anime/create', 'AnimeController@postCreate');
    $router->get('anime/edit/{id}', 'AnimeController@getEdit');
    $router->post('anime/edit/{id}', 'AnimeController@postEdit');
    $router->get('anime/delete/{id}', 'AnimeController@getDelete');

    // Admin episodes routes...
    $router->get('episodes', 'EpisodeController@index');
    $router->get('episodes/create', 'EpisodeController@getCreate');
    $router->post('episodes/create', 'EpisodeController@postCreate');
    $router->get('episodes/edit/{id}', 'EpisodeController@getEdit');
    $router->post('episodes/edit/{id}', 'EpisodeController@postEdit');
    $router->get('episodes/delete/{id}', 'EpisodeController@getDelete');

    // Admin pages routes...
    $router->get('pages', 'PageController@index');
    $router->get('pages/create', 'PageController@getCreate');
    $router->post('pages/create', 'PageController@postCreate');
    $router->get('pages/edit/{id}', 'PageController@getEdit');
    $router->post('pages/edit/{id}', 'PageController@postEdit');
    $router->get('pages/delete/{id}', 'PageController@getDelete');

    // Admin images routes...
    $router->get('images', 'ImageController@index');
    $router->get('images/create', 'ImageController@getCreate');
    $router->post('images/create', 'ImageController@postCreate');
    $router->get('images/edit/{id}', 'ImageController@getEdit');
    $router->post('images/edit/{id}', 'ImageController@postEdit');
    $router->get('images/delete/{id}', 'ImageController@getDelete');

    // Admin options routes...
    $router->get('options/edit', 'OptionController@getEdit');
    $router->post('options/edit', 'OptionController@postEdit');

    // Admin cache routes...
    $router->get('purge-cache', 'CacheController@getPurge');
});
