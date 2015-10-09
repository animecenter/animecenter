<?php

namespace AC\Http\Controllers;

use AC\Models\Page;
use AC\Repositories\EloquentAnimeRepository as Anime;
use AC\Repositories\EloquentEpisodeRepository as Episode;

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
     * @param Page $page
     * @param Anime $anime
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
        $this->data['animes'] = $this->anime->currentSeason();

        // TODO: Get meta data...
        $this->data['pageTitle'] = 'AnimeCenter: Watch Anime English Subbed/Dubbed Online in HD';
        $this->data['metaTitle'] = 'Watch Anime Online English Subbed/Dubbed | Watch Anime Online Free';
        $this->data['metaDesc'] = 'Watch Anime English Subbed/Dubbed Online in HD at AnimeCenter! Over 41000 Episodes' .
            ', and 2,146 Anime Series!';
        $this->data['metaKey'] = 'Watch Anime Online, Anime Subbed/Dubbed, Anime Episodes, Anime Stream, ' .
            'Subbed Anime, Dubbed Anime';

        return view('pages.home', $this->data);
    }

    /**
     * Get page by slug.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getBySlug($slug = '')
    {
        return view('pages.show', ['page' => $this->page->where('slug', '=', $slug)->take(1)->findOrFail()]);
    }
}
