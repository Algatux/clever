<?php

declare(strict_types = 1);

namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Config\ApplicationConfiguration;
use Clever\Services\Doctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Application as Console;

/**
 * Class ApplicationProvider
 */
final class ApplicationProvider extends CleverServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Application service
        $this->app->singleton(
            'clever.app',
            function () {
                return new Console(CleverApplication::NAME, CleverApplication::VERSION);
            }
        );

        // Database Services
        $this->app->singleton(
            EntityManagerFactory::class,
            function () {
                /** @var ApplicationConfiguration $databaseConfig */
                $databaseConfig = $this->app->make(ApplicationConfiguration::class);

                return new EntityManagerFactory($databaseConfig);
            }
        );

        $this->app->singleton(
            EntityManagerInterface::class,
            function () {
                /** @var EntityManagerFactory $factory */
                $factory = $this->app->make(EntityManagerFactory::class);

                return $factory->createEntityManager();
            }
        );
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {
    }

}
