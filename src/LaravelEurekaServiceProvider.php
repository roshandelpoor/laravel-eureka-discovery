<?php

namespace Eureka\LaravelEureka;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Eureka\LaravelEureka\commands\LaravelEurekaDiscoverCommand;

class LaravelEurekaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-eureka');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-eureka');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes/eureka.php';
        }

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . '/../config/eureka.php' => config_path('eureka.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-eureka'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-eureka'),
            ], 'assets');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-eureka'),
            ], 'lang');

            $this->commands([
                'discover-eureka',
            ]);

            $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('discover-eureka')->everyMinute();
            });
        }
    }

    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/eureka.php', 'laravel-eureka');

        $this->app->singleton('discover-eureka', function ($app) {
            return new LaravelEurekaDiscoverCommand;
        });
    }
}
