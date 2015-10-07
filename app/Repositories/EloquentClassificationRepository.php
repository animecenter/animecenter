<?php

namespace AC\Repositories;

use AC\Models\Classification;
use Carbon\Carbon;

class EloquentClassificationRepository
{
    /**
     * @var Classification
     */
    private $classification;

    /**
     * @param Classification $classification
     */
    public function __construct(Classification $classification)
    {
        $this->classification = $classification;
    }

    public function all()
    {
        return $this->classification->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->get(['id', 'name']);
    }
}
