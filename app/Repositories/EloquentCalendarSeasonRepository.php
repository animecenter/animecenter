<?php

namespace AC\Repositories;

use AC\Models\CalendarSeason;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class EloquentCalendarSeasonRepository
{
    /**
     * @var CalendarSeason
     */
    private $calendarSeason;

    /**
     * @param CalendarSeason $calendarSeason
     */
    public function __construct(CalendarSeason $calendarSeason)
    {
        $this->calendarSeason = $calendarSeason;
    }

    public function all()
    {
        return $this->calendarSeason->whereHas('animes', function (Builder $query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->orderBy('name', 'DESC')->get(['id', 'name']);
    }
}
