<?php

namespace AC\Http\Controllers;

use AC\Repositories\EloquentAnimeRepository as Anime;
use AC\Repositories\EloquentEpisodeRepository as Episode;
use AC\Repositories\EloquentMirrorRepository as Mirror;

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
     * @var Mirror
     */
    private $mirror;

    /**
     * @param Anime $anime
     * @param Episode $episode
     * @param Mirror $mirror
     */
    public function __construct(Anime $anime, Episode $episode, Mirror $mirror)
    {
        $this->anime = $anime;
        $this->episode = $episode;
        $this->mirror = $mirror;
    }

    /**
     * Get anime by slug.
     *
     * @param string $animeSlug
     * @return \Illuminate\View\View
     */
    public function getBySlug($animeSlug = '')
    {
        $this->data['anime'] = $anime = $this->anime->getBySlug($animeSlug);
        $this->data['producersCount'] = $anime['producers']->count() - 1;

        // TODO: Update number of views
        // $this->anime->where('id', '=', $anime['id'])->update(['visits' => $anime['visits'] + 1]);

        $this->data['lastEpisode'] = $this->episode->getLastEpisode($anime['id']);

        return view('anime.show', $this->data);
    }

    /**
     * Get episode by anime slug and by episode number.
     *
     * @param string $animeSlug
     * @param int $episodeNumber
     * @return \Illuminate\View\View
     */
    public function getEpisode($animeSlug = '', $episodeNumber = 0)
    {
        $this->data['anime'] = $anime = $this->anime->getMirrors($animeSlug, $episodeNumber);

        // TODO: Update episode views + 1...
        // $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);

        $this->data['prevEpisode'] = $this->episode->getPreviousEpisode($anime['id'], $anime['episode']->number);
        $this->data['nextEpisode'] = $this->episode->getNextEpisode($anime['id'], $anime['episode']->number);

        // TODO: Get episode meta data.
        $this->data['pageTitle'] = $title = $anime['title'] . " English Subbed/Dubbed in HD";
        $this->data['metaTitle'] = "Watch {$anime['title']} Online for Free | Watch Anime Online Free";
        $this->data['metaDesc'] = "Watch " . $title . " Online. Download " . $title . " Online. Watch " .
            $anime['title'] . " English Sub/Dub HD";
        $this->data['metaKey'] = "Watch {$anime['title']}, {$anime['title']} English Subbed/Dubbed, Download " .
            "{$anime['title']} English Subbed/Dubbed, Watch {$anime['title']} Online";

        return view('episodes.show', $this->data);
    }

    public function getEpisodeMirror($animeSlug = '', $mirrorName = '')
    {
        $mirrors = ['hd', 'mirror1', 'mirror2', 'mirror3', 'mirror4', 'raw', 'subdub'];
        if (!in_array($mirrorName, $mirrors)) {
            abort(404, "That is not a valid mirror!");
        }
        $this->data['episode'] = $episode = $this->episode->with('anime')
            ->where('slug', '=', $animeSlug)->where($mirrorName, '<>', '')->firstOrFail();

        // TODO: Update episode views + 1...
        // $this->episode->where('id', '=', $episode['id'])->update(['visits' => $episode['visits'] + 1]);

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
