<?php

namespace AC\Repositories;

use AC\Models\Mirror;

class EloquentMirrorRepository
{
    /**
     * @var Mirror
     */
    private $mirror;

    /**
     * @param Mirror $mirror
     */
    public function __construct(Mirror $mirror)
    {
        $this->mirror = $mirror;
    }
}
