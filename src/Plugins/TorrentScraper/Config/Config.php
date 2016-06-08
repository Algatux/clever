<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Config;

use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Config
 */
final class Config
{

    /** @var string */
    private $query;

    /** @var string */
    private $driver;

    /**
     * Config constructor.
     *
     * @param InputInterface $inputInterface
     */
    public function __construct(InputInterface $inputInterface)
    {
        $this->query = $inputInterface->getArgument('query');
        $this->driver = $inputInterface->getOption('driver');
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @return bool
     */
    public function mustUseSpecificDriver(): bool
    {
        return null !== $this->driver;
    }

}
