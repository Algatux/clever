<?php

namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Commands\SchemaMigrationCreate;
use Symfony\Component\Console\Application as Console;
use Symfony\Component\Console\Application;

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
    {
        /** @var Application $clever */
        $clever = $this->app->make('clever.app');
        $clever->add(new SchemaMigrationCreate($this->app));
    }
}
