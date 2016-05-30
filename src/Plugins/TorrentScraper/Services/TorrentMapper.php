<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;


use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Clever\Plugins\TorrentScraper\ValueObject\ScraperResult;

/**
 * Class TorrentMapper
 * @package Clever\Plugins\TorrentScraper\Services
 */
class TorrentMapper
{

    /**
     * @param ScraperResult $scraperResult
     * @return Torrent
     */
    public function fromScraperResultToTorrentModel(ScraperResult $scraperResult): Torrent
    {
        $torrent = new Torrent();
        $torrent->setName($scraperResult->getName());
        $torrent->setMagnetLink($scraperResult->getMagnet());

        return $torrent;
    }

}
