<?php

namespace Easyship\Facades;

use Illuminate\Support\Facades\Facade;

class Easyship extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'easyship.api';
    }
}
