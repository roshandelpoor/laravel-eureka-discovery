<?php

namespace Eureka\LaravelEureka\Commands;

use Eureka\LaravelEureka\Factories\LaravelEurekaFactory;
use Illuminate\Console\Command;

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
            $client = LaravelEurekaFactory::getEurekaClient();

            if($client->isRegistered()) {
                $client->deRegister();
            }

            $client->register();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        echo "\n";
        $this->info("| LaravelEurekaDiscoverCommand Application End |");
        echo "\n";

        return true;
    }
}
