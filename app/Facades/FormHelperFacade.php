<?php

namespace AC\Facades;

use Illuminate\Support\Facades\Facade;

class FormHelperFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'formhelper';
    }
}
