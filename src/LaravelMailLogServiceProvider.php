<?php

namespace Giuga\LaravelMailLog;

use Illuminate\Support\ServiceProvider;

class LaravelMailLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-mail-log');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            // Publishing the config.
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mail-log.php'),
            ], 'maillog-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(MailEventServiceProvider::class);
        $this->app->register(MailPolicyServiceProvider::class);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'maillog-config');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-mail-log', function () {
            return new LaravelMailLog;
        });
    }
}
