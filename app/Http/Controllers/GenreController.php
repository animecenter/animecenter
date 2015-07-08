<?php

namespace App\Http\Controllers;

use App\Anime\Anime;
use App\Genres\Genre;
use App\Options\Option;
use App\Pages\Page;

/**
 * @property  data
 */
class GenreController extends Controller
{
    private $data;

    /**
     * @var
     */
    private $genre;
    /**
     * @var Anime
     */
    private $anime;

    /**
     * @param Genre $genre
     * @param Anime $anime
     * @param Page $page
     * @param Option $option
     */
    public function __construct(Genre $genre, Anime $anime, Page $page, Option $option)
    {
        $this->genre = $genre;
        $this->anime = $anime;
        $this->option = $option;
        $this->page = $page;
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->where('type2', '=', 'subbed')->take(1)->first();
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')
            ->orderBy('order')->get();
        $this->data['bottomPagesList'] = $this->page->where('position', '=', 'bottom1')
            ->orderBy('order')->get();
        $this->data['bottomPagesList2'] = $this->page->where('position', '=', 'bottom2')
            ->orderBy('order')->get();
        $this->data['bottomPagesList3'] = $this->page->where('position', '=', 'bottom3')
            ->orderBy('order')->get();
        $this->data['options'] = $this->option->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->data['pageTitle'] = $pageTitle = "Category Browser";
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
        $this->data['genres'] = $this->genre->orderBy('value')->get();

        return view('genres.index', $this->data);
    }
}
