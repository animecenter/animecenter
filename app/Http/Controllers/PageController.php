<?php

namespace AC\Http\Controllers;

use AC\Models\Anime;
use AC\Models\Episode;
use AC\Models\Page;

class PageController extends Controller
{
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
        $this->data['episodes'] = $this->episode->with('anime')->orderBy('updated_at', 'DESC')->take('12')->get();
        $this->data['upcomingEpisodes'] = $this->episode->with('anime')->where('aired_at', '<>', '')
            ->orderBy('aired_at', 'ASC')->take(5)->get();
        $this->data['animes'] = $this->anime->orderBy('id', 'DESC')->take(12)->get();

        $this->data['pageTitle'] = $title = "AnimeCenter: Watch Anime English Subbed/Dubbed Online in HD";
        $this->data['metaTitle'] = "Watch Anime Online English Subbed/Dubbed | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch Anime English Subbed/Dubbed Online in HD at AnimeCenter! Over 41000 Episodes" .
            ", and 2,146 Anime Series!";
        $this->data['metaKey'] = "Watch Anime Online, Anime Subbed/Dubbed, Anime Episodes, Anime Stream, " .
            "Subbed Anime, Dubbed Anime";

        return view('pages.home', $this->data);
    }
}
