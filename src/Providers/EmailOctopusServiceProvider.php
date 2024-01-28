<?php

declare(strict_types=1);

namespace GoranPopovic\EmailOctopus\Providers;

use Exception;
use GoranPopovic\EmailOctopus\EmailOctopus;
use Illuminate\Support\ServiceProvider;

final class EmailOctopusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/email-octopus.php' => config_path('email-octopus.php'),
            ], 'email-octopus-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../../config/email-octopus.php', 'email-octopus');

        // Register the main class to use with the facade
        $this->app->singleton('email.octopus', function () {
            $apiKey = config('email-octopus.api_key');

            if (! is_string($apiKey)) {
                throw new Exception('Email octopus API Key is required. Please set it in your .env file.');
            }

            return EmailOctopus::client(
                $apiKey,
                config('email-octopus.base_uri'),
                config('email-octopus.timeout'),
                config('email-octopus.connect_timeout')
            );
        });
    }
}
