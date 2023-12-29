<?php

namespace Eureka\LaravelEureka\Exceptions;

use Exception;

class ServiceUnavailableException extends Exception
{
    public function __construct($serviceName)
    {
        parent::__construct("Service '{$serviceName}' are unavailable");
    }
}
