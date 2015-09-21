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
        $this->data['animeBanner'] = $this->anime->orderByRaw("RAND()")->where('type2', '=', 'subbed')->take(1)->first();
        $this->data['topPagesList'] = $this->page->where('position', '=', 'top')->orderBy('order')->get();
        $this->data['bottomPagesList'] = $this->page->where('position', '=', 'bottom1')->orderBy('order')->get();
        $this->data['bottomPagesList2'] = $this->page->where('position', '=', 'bottom2')->orderBy('order')->get();
        $this->data['bottomPagesList3'] = $this->page->where('position', '=', 'bottom3')->orderBy('order')->get();
        $this->data['options'] = $this->option->all();
    }

    public function getSubbedAnimeList($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->get();
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Subbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Subbed. Watch English Sub, Download " .
            "Anime for free. Watch Online English Subbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Subbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

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
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Dubbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Dubbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Dubbed. Watch English Dub, Download " .
            "Anime for free. Watch Online English Dubbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Dubbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.list-dubbed', $this->data);
    }

    public function getBrowseSubbed($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else if (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->where('type2', '<>', 'dubbed')
                ->orderBy('title', 'ASC')->paginate(20);
        } else {
            return redirect()->back();
        }
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Subbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Subbed. Watch English Sub, Download " .
            "Anime for free. Watch Online English Subbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Subbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

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
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Dubbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Dubbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Dubbed. Watch English Dub, Download " .
            "Anime for free. Watch Online English Dubbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Dubbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.browse-dubbed', $this->data);
    }

    public function getSubbedAnime($slug)
    {
        $this->data['anime'] = $anime = $this->anime->with(['episodes' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->where('slug', '=', $slug)->where('type2', '<>', 'dubbed')->firstOrFail();
        $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);
        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', NULL)
            ->orWhere('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', '')
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
        $this->data['pageTitle'] = $title = $anime['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $anime['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download " .
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

        ini_set("error_reporting", "E_ALL");
        return view('anime.show', $this->data);
    }

    public function getDubbedAnime($slug)
    {
        $this->data['anime'] = $anime = $this->anime->with(['episodes' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->where('slug', '=', $slug)->where('type2', '=', 'dubbed')->firstOrFail();
        $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);
        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', NULL)
            ->orWhere('anime_id', '=', $anime['id'])
            ->where('not_yet_aired', '=', '')
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
        $this->data['pageTitle'] = $title = $anime['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $anime['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download " .
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

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
        $this->data['pageTitle'] = "Latest Anime | Watch Anime Online Free";
        $this->data['metaTitle'] = "Watch the Latest Anime for Free Online | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = "Watch Latest Anime added to the site! Latest English Subbed/Dubbed Anime";
        $this->data['metaKey'] = "Latest Anime, Watch Latest Anime, Watch on Iphone, Watch Anime" .
            " Online, English Subbed/Dubbed";

        return view('anime.latest', $this->data);
    }
}
