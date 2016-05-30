<?php
declare(strict_types=1);
namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Config\ApplicationConfiguration;
use Clever\Services\Doctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
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
        $this->app->bind(EntityManagerFactory::class, function(){
            /** @var ApplicationConfiguration $databaseConfig */
            $databaseConfig = $this->app->make(ApplicationConfiguration::class);

            return new EntityManagerFactory($databaseConfig);
        });

        $this->app->bind(EntityManagerInterface::class, function() {
            /** @var EntityManagerFactory $factory */
            $factory = $this->app->make(EntityManagerFactory::class);

            return $factory->createEntityManager();
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
