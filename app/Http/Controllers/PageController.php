<?php

namespace AC\Http\Controllers;

use AC\Models\Meta;
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
     * @var Meta
     */
    private $meta;

    /**
     * @param Page $page
     * @param Anime $anime
     * @param Episode $episode
     * @param Meta $meta
     */
    public function __construct(Page $page, Anime $anime, Episode $episode, Meta $meta)
    {
        $this->page = $page;
        $this->anime = $anime;
        $this->episode = $episode;
        $this->meta = $meta;
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
        $this->data['animes'] = $this->anime->latest();
        $this->data['meta'] = $this->meta->whereRoute('/')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description']);

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
        return view('app.pages.show', [
            'page' => $this->page->where('slug', '=', $slug)->take(1)->findOrFail()
        ]);
    }
}
