<?php

namespace YPC\Ripple\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Relation extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'relation';
    }

}
