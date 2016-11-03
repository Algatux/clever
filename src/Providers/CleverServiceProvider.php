<?php

declare(strict_types = 1);

namespace Clever\Providers;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Application as Console;

/**
 * Class CleverServiceProvider
 */
abstract class CleverServiceProvider
{
    /** @var Container */
    protected $container;

    /**
     * CleverServiceProvider constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Console
     */
    protected function clever(): Console
    {
        return $this->container->make('clever.console');
    }

    /**
     * Register Parameters.
     *
     * @return void
     */
    abstract public function registerParameters();

    /**
     * Register Services.
     *
     * @return void
     */
    abstract public function registerServices();

    /**
     * Register the console commands.
     *
     * @return void
     */
    abstract public function registerConsoleCommands();
}
