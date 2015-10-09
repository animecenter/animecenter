<?php

namespace AC\Http\Controllers;

use AC\Repositories\EloquentAnimeRepository as Anime;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $data;

    private $rules = [
        'title' => 'string',
        'genres' => 'array',
        'scope' => 'string|alpha|max:3'
    ];

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @param Anime $anime
     */
    public function __construct(Anime $anime)
    {
        $this->anime = $anime;
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
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " .
            $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle .
            "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime " .
            "online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
        $this->data['genres'] = $this->genre->orderBy('value')->get();

        return view('search.index', $this->data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return view
     */
    public function show(Request $request)
    {
        $this->validate($request, $this->rules);
        $this->data['pageTitle'] = $pageTitle = 'Animecenter.tv';
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " .
            $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle .
            "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online," .
            " English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
        if ($request['scope'] && $request['genres']) {
            $genres = $request['genres'];
            if ($request['scope'] === 'all') {
                $genres = implode(",", $genres);
                $animes = $this->anime->where('title', 'LIKE', '%'.$request['title'].'%')
                    ->where('genres', 'LIKE', '%'.$genres.'%')
                    ->orderBy('title', 'ASC')
                    ->get();
            } else {
                $animes = $this->anime->where('title', 'LIKE', '%'.$request['title'].'%')
                    ->where(function ($query) use ($genres) {
                        foreach ($genres as $genre) {
                            $query->orWhere('genres', 'LIKE', '%'.$genre.'%');
                        }
                    })
                    ->orderBy('title', 'ASC')
                    ->get();
            }
        } else {
            $animes = $this->anime->where('title', 'LIKE', '%'.$request['title'].'%')
                ->orderBy('title', 'ASC')
                ->get();
        }
        $this->data['query'] = $request['genres'] ? $genres : $request['title'];
        $this->data['animes'] = $this->getRelatedForEachAnime($animes);

        return view('search.show', $this->data);
    }
}
