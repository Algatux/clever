<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Services\Mappers;

use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Clever\Plugins\TorrentScraper\Services\Mappers\Decorators\TorrentTagsDecorator;
use Clever\Plugins\TorrentScraper\ValueObject\ScraperResult;

/**
 * Class TorrentMapper
 */
final class TorrentMapper
{

    /**
     * TorrentMapper constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param ScraperResult $scraperResult
     *
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
