<?php

declare(strict_types = 1);

namespace Clever\Command;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;

/**
 * Class CleverCommand.
 */
abstract class CleverCommand extends Command
{
    /** @var  Container */
    private $container;

    /**
     * CleverCommand constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->setContainer($container);
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
