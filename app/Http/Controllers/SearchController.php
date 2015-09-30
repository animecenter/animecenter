<?php

namespace AC\Http\Controllers;

use AC\Anime\Anime;
use AC\Options\Option;
use AC\Pages\Page;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var Anime
     */
    private $anime;

    private $data;

    private $rules = [
        'title' => 'string',
        'genres' => 'array',
        'scope' => 'string|alpha|max:3'
    ];
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
     * @param Page $page
     * @param Option $option
     */
    public function __construct(Anime $anime, Page $page, Option $option)
    {
        $this->anime = $anime;
        $this->page = $page;
        $this->option = $option;
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
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";
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

    public function getRelatedForEachAnime(Collection $animes)
    {
        $relations = [
            'prequel', 'sequel', 'story', 'side_story', 'spin_off', 'alternative', 'other'
        ];
        foreach ($animes as $key => $anime) {
            foreach ($relations as $relation) {
                if ($anime[$relation]) {
                    $animesRelated = explode(',', $anime[$relation])[0];
                    $anime[$relation] = $this->anime
                        ->where('id', '=', $animesRelated)
                        ->first();
                }
            }
            $animes[$key] = $anime;
        }
        return $animes;
    }
}
