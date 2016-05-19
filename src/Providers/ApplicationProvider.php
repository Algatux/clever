<?php
declare(strict_types=1);
namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Config\ApplicationConfiguration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\Console\Application as Console;

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

        $this->app->singleton('clever.app', function() {
            return new Console(CleverApplication::NAME,CleverApplication::VERSION);
        });

        // Filesystem services

        // Database Services
        $this->app->singleton('capsule', function() {
            /** @var ApplicationConfiguration $databaseConfig */
            $databaseConfig = $this->app->make(ApplicationConfiguration::class);
            $capsule = new Capsule();

            $capsule->addConnection($databaseConfig->getConfig()->get('database'));
            $capsule->setAsGlobal();

            return $capsule;
        });
        $this->app->alias('capsule', 'db');

        Facade::setFacadeApplication($this->app);
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {}

}
