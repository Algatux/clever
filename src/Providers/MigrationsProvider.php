<?php
declare(strict_types = 1);
namespace Clever\Providers;

use Clever\Commands\SchemaMigrationCreate;
use Clever\Services\MigrationFinder;
use Clever\Services\MigrationRunner;
use Illuminate\Database\Migrations\MigrationCreator;
use Symfony\Component\Console\Application;

/**
 * Class MigrationsProvider
 * @package Clever\Providers
 */
class MigrationsProvider extends CleverServiceProvider
{

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

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('migration.creator', MigrationCreator::class);
        $this->app->bind('migration.finder', function(){
            return new MigrationFinder(
                $this->app->make('finder'),
                $this->app->make('config')
            );
        });
        $this->app->bind('migration.runner', function(){
            return new MigrationRunner(
                $this->app->make('filesystem')
            );
        });
    }
}