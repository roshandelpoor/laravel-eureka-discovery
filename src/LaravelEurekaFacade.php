<?php

namespace Eureka\LaravelEureka;

use Illuminate\Support\Facades\Facade;

class LaravelEurekaFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-eureka';
    }
}
