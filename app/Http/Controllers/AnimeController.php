<?php

namespace App\Http\Controllers;

use App\Anime\Anime;
use App\Episodes\Episode;
use App\Options\Option;
use App\Pages\Page;

/**
 * @property  data
 */
class AnimeController extends Controller
{
    protected $data;

    /**
     * @var Anime
     */
    private $anime;

    /**
     * @var Episode
     */
    private $episode;

    /**
     * @var Option
     */
    private $option;

    /**
     * @var Page
     */
    private $page;

    /**
     * @param Anime $anime
     * @param Episode $episode
     * @param Option $option
     * @param Page $page
     */
    public function __construct(Anime $anime, Episode $episode, Option $option, Page $page)
    {
        $this->anime = $anime;
        $this->episode = $episode;
        $this->option = $option;
        $this->page = $page;
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")
            ->where('type2', '=', 'subbed')->take(1)->first();
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

    public function getSubbedAnimeList($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List";
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

        return view('anime.list-subbed', $this->data);
    }

    public function getDubbedAnimeList($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List";
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

        return view('anime.list-dubbed', $this->data);
    }

    public function getBrowseSubbed($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '!=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List";
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

        return view('anime.browse-subbed', $this->data);
    }

    public function getBrowseDubbed($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '=', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Dubbed Browse A-Z";
        $this->data['metaTitle'] = $pageTitle . " | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $pageTitle . "!,Watch " . $pageTitle . "! English Subbed/Dubbed,Watch " . $pageTitle . " English Sub/Dub, Download " . $pageTitle . " for free,Watch " . $pageTitle . "! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download " . $pageTitle . ",Watch " . $pageTitle . " on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

        return view('anime.browse-dubbed', $this->data);
    }

    public function getSubbedAnime($slug)
    {
        $this->data['anime'] = $anime = $this->anime->with(['episodes' => function ($query) {
            $query->orderBy('order');
        }])->where('slug', '=', $slug)->where('type2', '!=', 'dubbed')->firstOrFail();
        $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);
        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', null)
            ->orderBy('id', 'DESC')
            ->first();
        $this->data['genres'] = explode(",", $anime['genres']);
        $this->data['type'] = explode(",", $anime['type']);
        $countSimilar = $this->anime->where('id', '=', $anime['id'])
            ->where('genres', '=', $anime['genres'])
            ->take(12)->count();
        $this->data['animeSimilar'] = $this->anime->where('id', '=', $anime['id'])
            ->where('genres', '=', $anime['genres'])
            ->take(rand(0, $countSimilar))
            ->get();
        switch ($anime['age']) {
            case "Anyone":
                $color = "#EE82EE";
                break;
            case "Teen +17":
                $color = "#CC0033";
                break;
            case "Teen +18":
                $color = "#FF0000";
                break;
            default:
                $color = "#C86464";
        }
        $this->data['color'] = $color;
        $this->data['relations'] = $this->getRelated($anime);

        return view('anime.show', $this->data);
    }

    public function getDubbedAnime($slug)
    {
        $this->data['anime'] = $anime = $this->anime->with(['episodes' => function ($query) {
            $query->orderBy('order');
        }])->where('slug', '=', $slug)->where('type2', '=', 'dubbed')->firstOrFail();
        $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);
        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', null)
            ->orderBy('id', 'DESC')
            ->first();
        $this->data['genres'] = explode(",", $anime['genres']);
        $this->data['type'] = explode(",", $anime['type']);
        $countSimilar = $this->anime->where('id', '=', $anime['id'])
            ->where('genres', '=', $anime['genres'])
            ->take(12)->count();
        $this->data['animeSimilar'] = $this->anime->where('id', '=', $anime['id'])
            ->where('genres', '=', $anime['genres'])
            ->take(rand(0, $countSimilar))
            ->get();
        switch ($anime['age']) {
            case "Anyone":
                $color = "#EE82EE";
                break;
            case "Teen +17":
                $color = "#CC0033";
                break;
            case "Teen +18":
                $color = "#FF0000";
                break;
            default:
                $color = "#C86464";
        }
        $this->data['color'] = $color;
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->where('type2', '=', 'subbed')->take(1)->first();
        $this->data['relations'] = $this->getRelated($anime);

        return view('anime.show', $this->data);
    }

    public function getRelated(Anime $anime)
    {
        $relations = [
            'prequel', 'sequel', 'story', 'side_story', 'spin_off', 'alternative', 'other'
        ];
        $related = [];
        foreach ($relations as $relation) {
            if ($anime[$relation]) {
                $related[$relation] = $this->anime
                    ->where('id', '=', explode(',', $anime[$relation])[0])->first();
            }
        }
        return $related;
    }

    public function getLatest()
    {
        $this->data['animes'] = $this->anime->orderBy('id', 'DESC')->paginate(20);
        $this->data['metaTitle'] = "Latest Anime Series added to site | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch Latest Anime Series added to site!,Watch Latest Anime Series added to site! English Subbed/Dubbed,Watch Latest Anime Series added to site English Sub/Dub, Download Latest Anime Series added to site for free,Watch Latest Anime Series added to site! Online English Subbed and Dubbed  for Free Online only at Anime Center";
        $this->data['metaKey'] = "Download Latest Anime Series added to site,Watch Latest Anime Series added to site on iphone,watch anime online, English Subbed/Dubbed, English Sub/Dub,Watch Anime for free,Download Anime,High Quality Anime";

        return view('anime.latest', $this->data);
    }
}
