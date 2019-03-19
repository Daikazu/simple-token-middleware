<?php

namespace Daikazu\SimpleTokenMiddleware\Facades;

use Illuminate\Support\Facades\Facade;

class SimpleTokenMiddleware extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'simple-token-middleware';
    }
}
