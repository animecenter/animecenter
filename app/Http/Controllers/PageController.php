<?php

namespace AC\Http\Controllers;

use AC\Models\Page;
use AC\Repositories\EloquentAnimeRepository as Anime;
use AC\Repositories\EloquentEpisodeRepository as Episode;
use Carbon\Carbon;
use DB;

class PageController extends Controller
{
    protected $data;

    /**
     * @var Page
     */
    private $page;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Episode
     */
    private $episode;

    /**
     * @param Page    $page
     * @param Anime   $anime
     * @param Episode $episode
     */
    public function __construct(Page $page, Anime $anime, Episode $episode)
    {
        $this->page = $page;
        $this->anime = $anime;
        $this->episode = $episode;
    }

    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        $this->data['episodes'] = $this->episode->latest();
        $this->data['upcomingEpisodes'] = $this->episode->upcoming();
        $this->data['animes'] = $this->anime->currentCalendarSeason();

        /*$animesDirectories = array_diff(scandir('uploads/anime'), ['.', '..']);
        foreach ($animesDirectories as $animeID) {
            DB::connection('mysql')->table('images')->where('imageable_id', '=', $animeID)->update([
                'path' => array_diff(scandir('uploads/anime/'.$animeID), ['.', '..'])[2],
            ]);
        }*/

        /*$timestamp = Carbon::now()->toDateTimeString();
        $animes = DB::connection('mysql')->table('animes')->where('image_id', '=', NULL)->get(['id', 'slug']);

        foreach ($animes as $anime) {
            $oldAnime = DB::connection('mysql1')->table('animes')->where('id', '=', $anime->id)
                ->where('image', '<>', 'http://cdn.myanimelist.net/images/qm_50.gif')
                ->first(['image']);

            if ($oldAnime) {
                $animeImageFolder = 'uploads/anime/' . $anime->id;
                if (!is_dir($animeImageFolder)) {
                    mkdir($animeImageFolder, 0755, true);
                }

                $animeImage = $animeImageFolder.'/'.$anime->slug.'-'.str_slug(str_replace(':', '-', $timestamp)).'.jpg';
                if (!file_exists($animeImage)) {
                    copy($oldAnime->image, $animeImage);
                }

                $imageID = DB::connection('mysql')->table('images')->insertGetId([
                    'user_id' => 1,
                    'imageable_id' => $anime->id,
                    'imageable_type' => 'Anime',
                    'path' => $anime->slug . '-1.jpg',
                    'active' => 1,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);

                DB::connection('mysql')->table('animes')->where('id', '=', $anime->id)->update([
                    'image_id' => $imageID,
                ]);
            }
        }*/

        // TODO: Get meta data...
        $this->data['pageTitle'] = 'AnimeCenter: Watch Anime English Subbed/Dubbed Online in HD';
        $this->data['metaTitle'] = 'Watch Anime Online English Subbed/Dubbed | Watch Anime Online Free';
        $this->data['metaDesc'] = 'Watch Anime English Subbed/Dubbed Online in HD at AnimeCenter! Over 41000 Episodes'.
            ', and 2,146 Anime Series!';
        $this->data['metaKey'] = 'Watch Anime Online, Anime Subbed/Dubbed, Anime Episodes, Anime Stream, '.
            'Subbed Anime, Dubbed Anime';

        return view('app.pages.home', $this->data);
    }

    /**
     * Get page by slug.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function getBySlug($slug = '')
    {
        return view('app.pages.show', ['page' => $this->page->where('slug', '=', $slug)->take(1)->findOrFail()]);
    }
}
