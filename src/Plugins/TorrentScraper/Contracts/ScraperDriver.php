<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Contracts;

use Clever\Plugins\TorrentScraper\Config\Config;
use Illuminate\Support\Collection;

/**
 * Interface ScraperDriver
 * @package Clever\Plugins\TorrentScraper\Contracts
 */
interface ScraperDriver
{

    /**
     * @return string
     */
    public function getName():string;

    /**
     * @return bool
     */
    public function hasFastSearchQueryUrl(): bool;

    /**
     * @param Config $config
     * @return Collection
     */
    public function scrape(Config $config): Collection;
    
    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return string
     */
    public function getSearchboxSelector(): string;

    /**
     * @return string
     */
    public function getFormSelector(): string;

    /**
     * @return string
     */
    public function getRawResultsSelector(): string;

    /**
     * @return string
     */
    public function getResultTorrentNameSelector(): string;

}
