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
     * @param string $family
     *
     * @return Tag
     */
    public function fromTagDefinitionToTag(string $definition, string $family): Tag
    {
        $tag = new Tag();
        $tag->setName(strtolower($definition));
        $tag->setFamily(strtolower($family));

        return $tag;
    }
}
