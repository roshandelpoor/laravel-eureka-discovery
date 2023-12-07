<?php

namespace Eureka\LaravelEureka\commands;

use Illuminate\Console\Command;
use EurekaClient\EurekaClient;

class LaravelEurekaDiscoverCommand extends Command
{
    protected $signature = 'discover-eureka';
    protected $description = 'run this command for discover your app in eureka app';

    public function handle()
    {
        echo "\n";
        $this->info("| LaravelEurekaDiscoverCommand Application Start |");
        echo "\n";

        try {
            $client = new EurekaClient([
                'eurekaDefaultUrl' => config('laravel-eureka.url'),
                'hostName'         => gethostname(),
                'appName'          => config('app.name'),
                'ip'               => request()->ip(),
                'port'             => [request()->getPort(), true],
                'homePageUrl'      => config('app.url'),
                'statusPageUrl'    => config('app.url') . '/actuator',
                'healthCheckUrl'   => config('app.url') . '/actuator/health'
            ]);

            // refuse register your service instance from Eureka
            if($client->isRegistered()) {
                $client->deRegister();
            }

            // register your service instance with Eureka for first time
            $client->register();

            // send heartbeat to Eureka, to show the client is up (one-time heartbeat)
            $client->getEurekaConfig()->setHeartbeatInterval(60); // seconds
            $client->heartbeat();

            // fetch an instance of a service from Eureka
            $url = $client->fetchInstance("CONFIG-SERVER")->homePageUrl;
            var_dump($url);
        } catch (\Exception $e) {
            echo $e->getMessage();
        } catch (\Throwable $e) {
            echo $e->getMessage();
        }

        echo "\n";
        $this->info("| LaravelEurekaDiscoverCommand Application End |");
        echo "\n";

        return true;
    }
}
