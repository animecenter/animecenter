<?php

namespace AC\Repositories;

use AC\Models\Status;

class EloquentStatusRepository
{
    /**
     * @var Status
     */
    private $status;

    /**
     * @param Status $status
     */
    public function __construct(Status $status)
    {
        $this->status = $status;
    }
}
