<?php

namespace AC\Http\Controllers;

use AC\Models\Anime;
use AC\Models\Episode;
use Carbon\Carbon;

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
     * @param Anime $anime
     * @param Episode $episode
     */
    public function __construct(Anime $anime, Episode $episode)
    {
        $this->anime = $anime;
        $this->episode = $episode;
    }

    public function getIndex()
    {
        $this->data['animes'] = $this->anime->orderBy('id', 'DESC')->paginate(20);

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Subbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Subbed. Watch English Sub, Download " .
            "Anime for free. Watch Online English Subbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Subbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.index', $this->data);
    }

    public function getListByLetter($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime->where('title', 'like', 'a%')->orderBy('title', 'ASC')->paginate(20);
        } elseif ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('title', 'ASC')->paginate(20);
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime->where('title', 'like', $letter.'%')
                ->orderBy('title', 'ASC')->paginate(20);
        } else {
            // log user trying to access url that was not declare
            return redirect()->back();
        }

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Subbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Subbed. Watch English Sub, Download " .
            "Anime for free. Watch Online English Subbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Subbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.index', $this->data);
    }

    public function getSubbed($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->orderBy('title', 'ASC')->get();
        } elseif ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('title', 'ASC')->get();
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->orderBy('title', 'ASC')->get();
        } else {
            return redirect()->back();
        }

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Subbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Subbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Subbed. Watch English Sub, Download " .
            "Anime for free. Watch Online English Subbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Subbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.list-subbed', $this->data);
    }

    public function getDubbed($letter = '')
    {
        if (!$letter) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', 'a%')
                ->orderBy('title', 'ASC')->get();
        } elseif ($letter === '0-9') {
            $this->data['animes'] = $anime = $this->anime
                ->whereRaw("title NOT REGEXP '^[[:alpha:]]'")
                ->orderBy('title', 'ASC')->get();
        } elseif (preg_match('/^([a-z])$/', $letter) === 1) {
            $this->data['animes'] = $anime = $this->anime
                ->where('title', 'like', $letter.'%')
                ->orderBy('title', 'ASC')->get();
        } else {
            return redirect()->back();
        }

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = $pageTitle = "Watch Anime Online / Dubbed Anime List | Watch Anime Online Free";
        $this->data['metaTitle'] = "Dubbed Anime List for Free | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = $pageTitle . "!. Watch English Dubbed. Watch English Dub, Download " .
            "Anime for free. Watch Online English Dubbed Online for Free only at Anime Center";
        $this->data['metaKey'] = "Anime Dubbed, Watch Anime, Download Anime, Watch Anime on iphone, Anime for Free";

        return view('anime.list-dubbed', $this->data);
    }

    public function getBySlug($slug)
    {
        $this->data['anime'] = $anime = $this->anime->with([
            'type' => function ($query) {
            $query->select(['id', 'name']);
        }, 'episodes' => function ($query) {
            $query->orderBy('number', 'asc');
        }])->where('slug', '=', $slug)->firstOrFail();

        // TODO: Update number of views
        // $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);

        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('aired_at', '<', Carbon::now()->toDateTimeString())
            ->orderBy('number', 'DESC')->first();

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = $title = $anime['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $anime['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download " .
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

        return view('anime.show', $this->data);
    }

    public function getLatest()
    {
        $this->data['animes'] = $this->anime->orderBy('id', 'DESC')->paginate(20);

        // TODO: Meta data on view composer
        $this->data['pageTitle'] = "Latest Anime | Watch Anime Online Free";
        $this->data['metaTitle'] = "Watch the Latest Anime for Free Online | Watch Anime Online Free just in Animecenter.tv";
        $this->data['metaDesc'] = "Watch Latest Anime added to the site! Latest English Subbed/Dubbed Anime";
        $this->data['metaKey'] = "Latest Anime, Watch Latest Anime, Watch on Iphone, Watch Anime" .
            " Online, English Subbed/Dubbed";

        return view('anime.latest', $this->data);
    }
}
