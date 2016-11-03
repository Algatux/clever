<?php

declare(strict_types = 1);

namespace Clever\Plugins\JuniorWeb\Service\Scraper;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractScraper.
 */
abstract class AbstractScraper
{
    const BASE_URL = '/juniorweb/';

    /** @var Client */
    private $client;
    /** @var string */
    private $baseAddress;

    /**
     * AbstractScraper constructor.
     *
     * @param Client $client
     * @param string $baseAddress
     */
    public function __construct(Client $client, string $baseAddress)
    {
        $this->client = $client;
        $this->baseAddress = $baseAddress;
    }

    /**
     * @return Client
     */
    protected function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param string $url
     *
     * @return Crawler
     */
    protected function getUrl($url = self::BASE_URL): Crawler
    {
        return $this->client->request('GET', sprintf("%s%s", $this->baseAddress, $url));
    }
}
