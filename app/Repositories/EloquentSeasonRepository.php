<?php

namespace AC\Repositories;

use AC\Models\Season;
use Carbon\Carbon;

class EloquentSeasonRepository
{
    /**
     * @var Season
     */
    private $season;

    /**
     * @param Season $season
     */
    public function __construct(Season $season)
    {
        $this->season = $season;
    }

    public function all()
    {
        return $this->season->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->orderBy('name', 'DESC')->get(['id', 'name']);
    }
}