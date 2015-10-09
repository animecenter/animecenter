<?php

namespace AC\Repositories;

use AC\Models\Episode;
use Carbon\Carbon;

class EloquentEpisodeRepository
{
    /**
     * @var Episode
     */
    private $episode;

    /**
     * @param Episode $episode
     */
    public function __construct(Episode $episode)
    {
        $this->episode = $episode;
    }

    public function all()
    {
        return $this->episode->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->get(['id', 'name']);
    }

    /**
     * @param int $animeID
     * @param int $episodeNumber
     * @return mixed
     */
    public function getNextEpisode($animeID = 0, $episodeNumber = 0)
    {
        return $this->episode->with('anime')->where('anime_id', '=', $animeID)
            ->where('number', '>', $episodeNumber)->orderBy('number')->first();
    }

    /**
     * @param int $animeID
     * @param int $episodeNumber
     * @return mixed
     */
    public function getPreviousEpisode($animeID = 0, $episodeNumber = 0)
    {
        return $this->episode->with('anime')->where('anime_id', '=', $animeID)
            ->where('number', '<', $episodeNumber)->orderBy('number', 'DESC')->first();
    }

    /**
     * @param string $animeID
     * @return mixed
     */
    public function getLastEpisode($animeID = '')
    {
        return $this->episode->where('aired_at', '<', Carbon::now()->toDateTimeString())
            ->where('anime_id', '=', $animeID)->orderBy('number', 'DESC')->first();
    }
}
