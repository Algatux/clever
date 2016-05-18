<?php
declare(strict_types=1);
namespace Clever\Providers;

use Clever\Config\ApplicationConfiguration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\MigrationCreator;

/**
 * Class ApplicationProvider
 * @package Clever\ServiceProviders
 */
class ApplicationProvider extends CleverServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('capsule', function() {
            /** @var ApplicationConfiguration $databaseConfig */
            $databaseConfig = $this->app['config'];
            $capsule = new Capsule();

            $capsule->addConnection(
                $databaseConfig
                    ->getConfig()
                    ->get('database')
            );

            $capsule->setAsGlobal();

            return $capsule;
        });
        $this->app->alias('capsule', 'db');

        $this->app->bind('migration.creator', MigrationCreator::class);
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {}

}
