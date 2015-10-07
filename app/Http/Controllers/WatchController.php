<?php

namespace AC\Http\Controllers;

use AC\Http\Requests;
use AC\Models\Episode;
use AC\Repositories\EloquentAnimeRepository as Anime;
use Carbon\Carbon;

class WatchController extends Controller
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
     * @param Anime $anime
     * @param Episode $episode
     */
    public function __construct(Anime $anime, Episode $episode)
    {
        $this->anime = $anime;
        $this->episode = $episode;
    }

    public function getBySlug($slug)
    {
        $this->data['anime'] = $anime = $this->anime->getBySlug($slug);
        $this->data['producersCount'] = $anime->producers->count() - 1;

        // TODO: Update number of views
        // $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);

        $this->data['lastEpisode'] = $this->episode->where('anime_id', '=', $anime['id'])
            ->where('aired_at', '<', Carbon::now()->toDateTimeString())->orderBy('number', 'DESC')->first();

        return view('anime.show', $this->data);
    }

    public function getEpisode($slug)
    {
        $this->data['episode'] = $episode = $this->episode->with('anime')
            ->where('slug', '=', $slug)->firstOrFail();
        $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);
        $this->data['nextEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '>', $episode['order'])
            ->orderBy('order')
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '<', $episode['order'])
            ->orderBy('order', 'desc')
            ->first();
        $this->data['mainLink'] = $this->data['options'][4]['value'] . $episode['slug'];
        $this->data['pageTitle'] = $title = $episode['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$episode['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $episode['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$episode['title']}, {$episode['title']} English Subbed/Dubbed, Download " .
            "{$episode['title']} English Subbed/Dubbed, Watch {$episode['title']} Online";

        return view('episodes.show', $this->data);
    }

    public function getEpisodeMirror($slug, $mirror)
    {
        $mirrors = ['hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4', 'raw', 'subdub'];
        if (!in_array($mirror, $mirrors)) {
            abort(404, "That is not a valid mirror!");
        }
        $this->data['episode'] = $episode = $this->episode->with('anime')
            ->where('slug', '=', $slug)->where($mirror, '<>', '')->firstOrFail();
        $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);
        $this->data['nextEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '>', $episode['order'])
            ->orderBy('order')
            ->first();
        $this->data['prevEpisode'] = $this->episode
            ->where('anime_id', '=', $episode->anime->id)
            ->where('order', '<', $episode['order'])
            ->orderBy('order', 'desc')
            ->first();
        $this->data['mainLink'] = $this->data['options'][4]['value'] . $episode['slug'];
        $this->data['currentMirror'] = $mirror;
        $this->data['pageTitle'] = $title = $episode['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$episode['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $episode['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$episode['title']}, {$episode['title']} English Subbed/Dubbed, Download " .
            "{$episode['title']} English Subbed/Dubbed, Watch {$episode['title']} Online";

        return view('episodes.show', $this->data);
    }
}
