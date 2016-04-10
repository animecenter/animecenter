<?php

namespace AC\Repositories;

use AC\Models\Type;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

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
        return $this->type->whereHas('animes', function (Builder $query) {
            $query->has('episodes')->where('release_date', '<', Carbon::now()->toDateTimeString());
        })->where('model', '=', 'Anime')->get(['id', 'name']);
    }
}
