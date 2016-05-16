<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;
use Illuminate\Support\Collection;
use Goutte\Client as Goutte;
use Symfony\Component\DomCrawler\Crawler;

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
    public function addAdapert(ScraperDriver $adapter)
    {
        $hash = spl_object_hash($adapter);
        if (! $this->adapters->contains($hash)) {
            $this->adapters->put($hash, $adapter);
        }
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function scrape(array $params = null)
    {
        /** @var ScraperDriver $adapter */
        foreach ($this->adapters as $adapter) {

            $this->resultSet->push($adapter->scrape($params));

        }

        return $this->resultSet;
    }


    
}
