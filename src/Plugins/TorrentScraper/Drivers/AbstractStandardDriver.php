<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Drivers;

use Clever\Plugins\TorrentScraper\Config\Config;
use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;
use Clever\Plugins\TorrentScraper\ValueObject\ScraperResult;
use Goutte\Client as Goutte;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractStandardDriver
 */
abstract class AbstractStandardDriver implements ScraperDriver
{
    const NAME = '';
    const PROTOCOL = '';
    const BASE_URL = '';
    const SEARCH_QUERY_URL = '%s';

    /** @var Goutte */
    private $goutte;

    /**
     * AbstractStandardDriver constructor.
     *
     * @param Goutte $client
     */
    public function __construct(Goutte $client)
    {
        $this->goutte = $client;
    }

    /**
     * @param Config $config
     *
     * @return Collection
     */
    public function scrape(Config $config): Collection
    {
        $homePage = $this->goutte->request('GET', $this->getBaseUrl());

        $searchResult = $this->startSearch($homePage, $config->getQuery());

        $rawResults = $this->getRawResults($searchResult);

        $results = $rawResults->each(
            function (Crawler $node) {
                $nameCrawler = $node->filterXPath($this->getResultTorrentNameSelector());
                $magnet = $node->filterXPath($this->getResultTorrentMagnetSelector());

                return new ScraperResult($nameCrawler->text(), $magnet->attr('href'));
            }
        );

        return new Collection($results);
    }

    /**
     * @param Crawler $crawler
     * @param string  $query
     *
     * @return Crawler
     */
    private function startSearch(Crawler $crawler, string $query): Crawler
    {
        if ($this->hasFastSearchQueryUrl()) {
            $url = $this->getBaseUrl().sprintf($this::SEARCH_QUERY_URL, urlencode($query));

            return $this->goutte->request('GET', $url);
        }

        $form = $crawler->selectButton($this->getFormSelector())->form();
        $form['contentSearch'] = $query;

        return $this->goutte->submit($form);
    }

    /**
     * @param Crawler $crawler
     *
     * @return Crawler
     */
    private function getRawResults(Crawler $crawler): Crawler
    {
        $selector = $this->getRawResultsSelector();

        return $crawler->filterXPath($selector);
    }
}
