<?php

namespace Clever\Providers;

use Clever\CleverApplication;
use Symfony\Component\Console\Application as Console;

/**
 * Class ConsoleProvider
 * @package Clever\ServiceProviders
 */
class ConsoleProvider extends CleverServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('clever.app', function() {
            
            return new Console(CleverApplication::NAME,CleverApplication::VERSION);
        });
        
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {}
}
