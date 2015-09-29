<?php

namespace App\Http\Controllers;

use App\Anime\Anime;
use App\Episodes\Episode;
use App\Genres\Genre;
use App\Images\Image;
use App\Options\Option;
use App\Pages\Page;

class PageController extends Controller
{
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Episode
     */
    private $episode;

    /**
     * @var Genre
     */
    private $genre;

    /**
     * @var Image
     */
    private $image;

    /**
     * @var Page
     */
    private $page;

    /**
     * @var Option
     */
    private $option;

    /**
     * @param Anime $anime
     * @param Episode $episode
     * @param Genre $genre
     * @param Image $image
     * @param Page $page
     * @param Option $option
     */
    public function __construct(Anime $anime, Episode $episode, Genre $genre, Image $image, Page $page, Option $option)
    {
        $this->anime = $anime;
        $this->episode = $episode;
        $this->genre = $genre;
        $this->image = $image;
        $this->page = $page;
        $this->option = $option;
    }

    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function getHome()
    {
        $this->data['pageTitle'] = "Home";
        $this->data['desc'] = "Home Page";
        $this->data['animesCount'] = $this->anime->where('position', '=', 'recently')->orWhere('position', '=', 'all')
            ->get()->count();
        $this->data['episodesList'] = $this->episode->with('anime')->where('show', '=', 1)->orderBy('date', 'DESC')
            ->take('12')->get();
        $this->data['imagesList'] = $this->image->orderBy('date', 'DESC')->take(10)->get();
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')->orderBy('order')->get();
        $this->data['bottomPagesList'] = $this->page->where('position', '=', 'bottom1')->orderBy('order')->get();
        $this->data['bottomPagesList2'] = $this->page->where('position', '=', 'bottom2')->orderBy('order')->get();
        $this->data['bottomPagesList3'] = $this->page->where('position', '=', 'bottom3')->orderBy('order')->get();
        $this->data['options'] = $this->option->all();
        $this->data['animeList'] = $this->anime->where('position', '=', 'recently')->orWhere('position', '=', 'all')
            ->orderBy('id', 'DESC')->take(8)->get();
        $this->data['upcomingEpisodes'] = $this->episode->with('anime')->where('coming_date', '<>', '')
            ->where('not_yet_aired', '<>', '')->orderBy('coming_date', 'ASC')->take(6)->get();
        $this->data['pageTitle'] = $title = "AnimeCenter: Watch Anime English Subbed/Dubbed Online in HD";
        $this->data['metaTitle'] = "Watch Anime Online English Subbed/Dubbed | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch Anime English Subbed/Dubbed Online in HD at AnimeCenter! Over 41000 Episodes" .
            ", and 2,146 Anime Series!";
        $this->data['metaKey'] = "Watch Anime Online, Anime Subbed/Dubbed, Anime Episodes, Anime Stream, " .
            "Subbed Anime, Dubbed Anime";

        return view('pages.home', $this->data);
    }
}
