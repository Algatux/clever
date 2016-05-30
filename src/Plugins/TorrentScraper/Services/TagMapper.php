<?php

declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;

use Clever\Plugins\TorrentScraper\Entity\Tag;

/**
 * Class TagMapper
 * @package Clever\Plugins\TorrentScraper\Services
 */
class TagMapper
{

    /**
     * @param string $definition
     * @return Tag
     */
    public function fromTagDefinitionToTag(string $definition): Tag
    {
        $tag = new Tag();
        $tag->setName(strtolower($definition));

        return $tag;
    }

}
