<?php

declare(strict_types=1);

namespace Clever\Plugins\JuniorWeb\Model;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class BadgeUsageTableMap.
 */
class BadgeUsageTableMap
{
    /** @var array */
    private $data;

    /**
     * BadgeUsageTableMap constructor.
     *
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->data = [];
        $this->parse($crawler);
    }

    /**
     * @param Crawler $crawler
     */
    private function parse(Crawler $crawler)
    {
        $this->data = $crawler
            ->filter('tr')
            ->reduce(function(Crawler $node, int $i){
                if ($i === 0) {
                    return false;
                }
                return true;
            })
            ->each(function(Crawler $node){
                return new BadgeUsageDay($node);
            });
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
