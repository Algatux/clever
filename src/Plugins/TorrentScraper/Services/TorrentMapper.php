<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;
use Clever\Plugins\TorrentScraper\Models\Torrent;
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
        $torrent->name = $scraperResult->getName();
        $torrent->hash = sha1($scraperResult->getName());
        $torrent->magnetLink = $scraperResult->getMagnet();

        return $torrent;
    }

}
