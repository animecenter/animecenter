<?php

namespace AC\Repositories;

use AC\Models\Genre;
use Carbon\Carbon;

class EloquentGenreRepository
{
    /**
     * @var Genre
     */
    private $genre;

    /**
     * @param Genre $genre
     */
    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function all()
    {
        return $this->genre->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->where('model', '=', 'Anime')->orderBy('name')->get(['id', 'name']);
    }
}
