<?php

namespace Easyship\Facades;

use Easyship\EasyshipAPI;
use Illuminate\Support\Facades\Facade;

/** @mixin EasyshipAPI */
class Easyship extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'easyship.api';
    }
}
