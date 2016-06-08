<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Services;

use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Clever\Plugins\TorrentScraper\Services\Definitions\TagDefinitions;

/**
 * Class TorrentRiddler
 */
final class TorrentRiddler
{

    /**
     * @var TagDefinitions
     */
    private $tagDefinitions;

    /**
     * TorrentRiddler constructor.
     *
     * @param TagDefinitions $tagDefinitions
     */
    public function __construct(TagDefinitions $tagDefinitions)
    {
        $this->tagDefinitions = $tagDefinitions;
    }

    /**
     * @param Torrent $torrent
     *
     * @return array
     */
    public function findMatchingTags(Torrent $torrent)
    {
        $foundTags = [];
        $tagFamilies = $this->tagDefinitions->getMergedTags();

        foreach ($tagFamilies as $family => $tags) {

            foreach ($tags as $tag) {

                if (preg_match("/$tag/i", $torrent->getName())) {
                    $foundTags[$family] = $tag;
                }
            }

        }

        return $foundTags;

    }

}
