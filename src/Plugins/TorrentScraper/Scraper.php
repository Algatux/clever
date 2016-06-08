<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Config\Config;
use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;
use Clever\Plugins\TorrentScraper\Services\Mappers\TorrentMapper;
use Clever\Plugins\TorrentScraper\ValueObject\ScraperResult;
use Illuminate\Support\Collection;

/**
 * Class Scraper
 */
final class Scraper
{

    /** @var Collection|ScraperDriver */
    private $adapters;

    /** @var Collection */
    private $resultSet;
    /**
     * @var \Clever\Plugins\TorrentScraper\Services\Mappers\TorrentMapper
     */
    private $mapper;

    /**
     * Scraper constructor.
     *
     * @param TorrentMapper $mapper
     */
    public function __construct(TorrentMapper $mapper)
    {
        $this->adapters = new Collection;
        $this->resultSet = new Collection;
        $this->mapper = $mapper;
    }

    /**
     * @param ScraperDriver $adapter
     */
    public function addDriver(ScraperDriver $adapter)
    {
        $hash = spl_object_hash($adapter);
        if (!$this->adapters->contains($hash)) {
            $this->adapters->put($hash, $adapter);
        }
    }

    /**
     * @param Config $config
     *
     * @return Collection
     */
    public function scrape(Config $config): Collection
    {
        /** @var ScraperDriver $adapter */
        foreach ($this->adapters as $adapter) {

            if ($config->mustUseSpecificDriver() && $adapter->getName() !== $config->getDriver()) {
                continue;
            }

            $this->addResults($adapter->scrape($config));

        }

        return $this->resultSet;
    }

    /**
     * @param Collection|ScraperResult[] $results
     */
    private function addResults($results)
    {
        foreach ($results as $result) {
            $torrent = $this->mapper->fromScraperResultToTorrentModel($result);
            $this->resultSet->push($torrent);
        }
    }

}
