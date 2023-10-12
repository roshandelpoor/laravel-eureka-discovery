<?php

namespace Eureka\LaravelEureka;

use Illuminate\Support\ServiceProvider;

class LaravelEurekaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Load your package assets
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-eureka');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-eureka');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // $this->loadRoutesFrom(__DIR__.'/../routes/eureka.php');
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes/eureka.php';
        }

        // Publish All Configs
        if ($this->app->runningInConsole()) {
            // Publishing config
            $this->publishes([
                __DIR__ . '/../config/eureka.php' => config_path('eureka.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-eureka'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-eureka'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-eureka'),
            ], 'lang');

            // Registering package commands.
            $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/eureka.php', 'laravel-eureka');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-eureka', function () {
            return new LaravelEurekaController;
        });
    }
}
