<?php

namespace YPC\Ripple\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Description of Bread
 *
 * @author Yash Pal
 */
class Bread extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bread';
    }

}
