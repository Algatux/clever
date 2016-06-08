<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Drivers;

use Clever\Plugins\TorrentScraper\Contracts\ScraperDriver;

/**
 * Class Kikasstorrents
 */
final class Kikasstorrents extends AbstractStandardDriver implements ScraperDriver
{
    const NAME = 'kikass';
    const PROTOCOL = 'http://';
    const BASE_URL = 'kickasstorrentsam.com/';
    const SEARCH_QUERY_URL = '/usearch/%s';

    /**
     * @return string
     */
    public function getName():string
    {
        return self::NAME;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return self::PROTOCOL.self::BASE_URL;
    }

    /**
     * @return string
     */
    public function getSearchboxSelector(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getFormSelector(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    public function hasFastSearchQueryUrl(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getRawResultsSelector(): string
    {
        return "//*/table[@class='data']/tr[contains(@id,'torrent_')]";
    }

    /**
     * @return string
     */
    public function getResultTorrentNameSelector(): string
    {
        return "//*/div[@class='torrentname']/div/a[@class='cellMainLink']";
    }

    /**
     * @return string
     */
    public function getResultTorrentMagnetSelector(): string
    {
        return "//*/a[contains(@href,'magnet:')]";
    }
}
