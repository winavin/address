<?php

namespace Winavin\Address;

use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing the migration file.
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'address.migrations');
        
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/address.php' => config_path('address.php'),
        ], 'address.config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/address.php', 'address');
    }
}
