<?php

namespace AC\Repositories;

use AC\Models\Type;
use Carbon\Carbon;

class EloquentTypeRepository
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @param Type $type
     */
    public function __construct(Type $type)
    {
        $this->type = $type;
    }

    public function all()
    {
        return $this->type->whereHas('animes', function ($query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->where('model', '=', 'Anime')->get(['id', 'name']);
    }
}
