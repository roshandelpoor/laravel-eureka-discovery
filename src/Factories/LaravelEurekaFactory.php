<?php

namespace Eureka\LaravelEureka\Factories;

use Eureka\LaravelEureka\Exceptions\InstanceFailureException;
use Eureka\LaravelEureka\Exceptions\ServiceUnavailableException;
use EurekaClient\EurekaClient;
use Exception;

abstract class LaravelEurekaFactory
{
    private static $eurekaClient;
    private static $unavailableServices = [];

    public static function getEurekaClient()
    {
        if (!isset(self::$eurekaClient)) {
            self::$eurekaClient  = new EurekaClient([
                'eurekaDefaultUrl' => config('laravel-eureka.url'),
                'hostName'         => gethostname(),
                'appName'          => config('app.name'),
                'ip'               => request()->ip(),
                'port'             => [request()->getPort(), true],
                'homePageUrl'      => config('app.url'),
                'statusPageUrl'    => config('app.url') . '/actuator',
                'healthCheckUrl'   => config('app.url') . '/actuator/health'
            ]);
        }

        return self::$eurekaClient;
    }

    /**
     * This method was created for using it in requests or another short time execution code.
     * You probably don't want to do many requests for one service when it's not available,
     * because it will probably not register.
     * If you for some reason don't want to base on saved unavailable services, just use
     * @see EurekaClient::fetchInstance()
     * You probably want to use that method when you write a long time execution code.
     * @throws ServiceUnavailableException
     */
    public static function fetchInstance($serviceName)
    {
        if (in_array($serviceName, self::$unavailableServices)) {
            throw new ServiceUnavailableException($serviceName);
        }

        try {
            return self::getEurekaClient()->fetchInstance($serviceName);
        } catch (InstanceFailureException $ex) {
            self::$unavailableServices[] = $serviceName;

            throw new ServiceUnavailableException($serviceName);
        } catch (Exception $e) {
            self::$unavailableServices[] = $serviceName;

            throw new ServiceUnavailableException($serviceName);
        }
    }
}
