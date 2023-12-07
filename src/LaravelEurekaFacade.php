<?php

namespace Eureka\LaravelEureka;

use Illuminate\Support\Facades\Facade;

class LaravelEurekaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-eureka';
    }
}
