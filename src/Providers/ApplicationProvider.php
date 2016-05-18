<?php
declare(strict_types=1);
namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Config\ApplicationConfiguration;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Application as Console;
use Symfony\Component\Finder\Finder;

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
        $this->app->bind('filesystem', Filesystem::class);
        $this->app->bind('finder', Finder::class);

        // Database Services
        $this->app->singleton('capsule', function() {
            /** @var ApplicationConfiguration $databaseConfig */
            $databaseConfig = $this->app['config'];
            $capsule = new Capsule();

            $capsule->addConnection($databaseConfig->getConfig()->get('database'));
            $capsule->setAsGlobal();

            return $capsule;
        });
        $this->app->alias('capsule', 'db');
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {}

}
