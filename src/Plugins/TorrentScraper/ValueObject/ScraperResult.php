<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\ValueObject;

/**
 * Class ScraperResult
 */
class ScraperResult
{
    /**
     * @var string
     */
    private $name;

    /** @var  string */
    private $magnet;

    /**
     * ScraperResult constructor.
     *
     * @param string $name
     * @param string $magnet
     */
    public function __construct(string $name, string $magnet)
    {
        $this->name = trim($name);
        $this->magnet = trim($magnet);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMagnet(): string
    {
        return $this->magnet;
    }

}
