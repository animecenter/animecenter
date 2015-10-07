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
        $this->$episode = $episode;
    }

    public function all()
    {
        return $this->episode->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->get(['id', 'name']);
    }
}
