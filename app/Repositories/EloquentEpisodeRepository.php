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
        return $this->episode->whereHas('anime', function ($query) {
            $query->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->get(['id', 'name']);
    }

    /**
     * @return mixed
     */
    public function latest()
    {
        $timestamp = Carbon::now()->toDateTimeString();

        return $this->episode->whereHas('anime', function ($query) use ($timestamp) {
            $query->where('release_date', '<', $timestamp);
        })->has('mirror')->with(['anime', 'mirror'])->where('updated_at', '<', $timestamp)
            ->orderBy('updated_at', 'DESC')->take(12)->get();
    }

    /**
     * @return mixed
     */
    public function latestPaginate()
    {
        $timestamp = Carbon::now()->toDateTimeString();

        return $this->episode->whereHas('anime', function ($query) use ($timestamp) {
            $query->where('release_date', '<', $timestamp);
        })->with('anime')->where('updated_at', '<', $timestamp)->orderBy('updated_at', 'DESC')->paginate(20);
    }

    public function upcoming()
    {
        return $this->episode->with('anime')->where('aired_at', '>', Carbon::now()->toDateTimeString())
            ->orderBy('aired_at', 'ASC')->take(5)->get();
    }

    /**
     * @param int $animeID
     * @param int $episodeNumber
     *
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
     *
     * @return mixed
     */
    public function getPreviousEpisode($animeID = 0, $episodeNumber = 0)
    {
        return $this->episode->with('anime')->where('anime_id', '=', $animeID)
            ->where('number', '<', $episodeNumber)->orderBy('number', 'DESC')->first();
    }

    /**
     * @param string $animeID
     *
     * @return mixed
     */
    public function getLatestEpisode($animeID = '')
    {
        return $this->episode->where('aired_at', '<', Carbon::now()->toDateTimeString())
            ->where('anime_id', '=', $animeID)->orderBy('number', 'DESC')->first();
    }
}
