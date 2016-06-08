<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Services\Mappers;

use Clever\Plugins\TorrentScraper\Entity\Tag;

/**
 * Class TagMapper
 * @package Clever\Plugins\TorrentScraper\Services
 */
final class TagMapper
{
    /**
     * @param string $definition
     *
     * @return Tag
     */
    public function fromTagDefinitionToTag(string $definition): Tag
    {
        $tag = new Tag();
        $tag->setName(strtolower($definition));

        return $tag;
    }
}
