<?php

namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Commands\SchemaMigrationCreate;
use Clever\Commands\SchemaMigrationInstall;
use Clever\Commands\SchemaMigrationRun;
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
    {}

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {
        /** @var Application $clever */
        $clever = $this->app->make('clever.app');
    }
}
