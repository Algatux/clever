<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Contracts;

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
     * @param array $params
     * @return array
     */
    public function scrape(array $params=[]): array;
    
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



}
