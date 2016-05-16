<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Drivers;

use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;
use Goutte\Client as Goutte;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractStandardDriver
 * @package Clever\Plugins\TorrentScraper\Drivers
 */
abstract class AbstractStandardDriver implements ScraperDriver
{

    const NAME = '';

    const PROTOCOL = '';
    const BASE_URL = '';
    const SEARCH_QUERY_URL = '%s';

    /**
     * @var Goutte
     */
    private $goutte;

    /**
     * AbstractStandardDriver constructor.
     * @param Goutte $client
     */
    public function __construct(Goutte $client)
    {
        $this->goutte = $client;
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function scrape(array $parameters = []): array
    {
        $homePage = $this->goutte->request('GET', $this->getBaseUrl());

        $searchResult = $this->startSearch($homePage, $parameters['query']);

        die($searchResult->text());
    }

    /**
     * @param Crawler $crawler
     * @param string $query
     * @return Crawler
     */
    private function startSearch(Crawler $crawler, string $query): Crawler
    {
        if ($this->hasFastSearchQueryUrl()) {
            $url = $this->getBaseUrl() . sprintf($this::SEARCH_QUERY_URL, urlencode($query));

            return $this->goutte->request('GET', $url);
        }

        $form = $crawler->selectButton($this->getFormSelector())->form();
        $form['contentSearch'] = $query;

        return $this->goutte->submit($form);
    }

}
