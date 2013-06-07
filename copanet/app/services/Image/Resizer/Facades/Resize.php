<?php

namespace Services\Image\Resizer\Facades;

use Illuminate\Support\Facades\Facade;

class Resize extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'resize';
    }
}
