<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Config\Config;
use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;
use Illuminate\Support\Collection;

class Scraper
{

    /** @var Collection|ScraperDriver */
    private $adapters;

    /** @var Collection */
    private $resultSet;

    /**
     * Scraper constructor.
     */
    public function __construct()
    {
        $this->adapters = new Collection;
        $this->resultSet = new Collection;
    }

    /**
     * @param ScraperDriver $adapter
     */
    public function addDriver(ScraperDriver $adapter)
    {
        $hash = spl_object_hash($adapter);
        if (! $this->adapters->contains($hash)) {
            $this->adapters->put($hash, $adapter);
        }
    }

    /**
     * @param Config $config
     * @return Collection
     */
    public function scrape(Config $config)
    {
        /** @var ScraperDriver $adapter */
        foreach ($this->adapters as $adapter) {

            if ($config->mustUseSpecificDriver() && $adapter->getName() !== $config->getDriver()) {
                continue;
            }

            $this->resultSet->push($adapter->scrape($config));

        }

        return $this->resultSet;
    }


    
}
