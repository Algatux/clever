<?php

namespace Clever\Providers;

use Clever\Config\ApplicationConfiguration;

/**
 * Class ConfigurationProvider
 * @package Clever\ServiceProviders
 */
class ConfigurationProvider extends CleverServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return array
     */
    public function register()
    {
        $this->app->singleton(ApplicationConfiguration::class, ApplicationConfiguration::class);
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {}
    
}
