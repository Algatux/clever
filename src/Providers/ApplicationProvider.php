<?php

declare(strict_types = 1);

namespace Clever\Providers;

use Clever\CleverApplication;
use Clever\Config\ApplicationConfiguration;
use Clever\Services\Doctrine\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Application as Console;

/**
 * Class ApplicationProvider.
 */
final class ApplicationProvider extends CleverServiceProvider
{
    /**
     * Register Parameters.
     *
     * @return void
     */
    public function registerParameters()
    {
        $this->container->bind('clever.root_dir', CLEVER_ROOT_DIR);
    }

    /**
     * Register Services.
     *
     * @return void
     */
    public function registerServices()
    {

        // Application service
        $this->container->singleton(
            CleverApplication::APP_SERVICE_NAME,
            function () {
                return new Console(CleverApplication::NAME, CleverApplication::VERSION);
            }
        );

        // Database Services
        $this->container->singleton(
            EntityManagerFactory::class,
            function () {
                /** @var ApplicationConfiguration $databaseConfig */
                $databaseConfig = $this->container->make(ApplicationConfiguration::class);

                return new EntityManagerFactory($databaseConfig);
            }
        );

        $this->container->singleton(
            EntityManagerInterface::class,
            function () {
                /** @var EntityManagerFactory $factory */
                $factory = $this->container->make(EntityManagerFactory::class);

                return $factory->createEntityManager();
            }
        );
    }

    /**
     * Register the console commands.
     *
     * @return void
     */
    public function registerConsoleCommands()
    {
    }
}
