<?php

declare(strict_types = 1);

namespace Clever\Plugins\JuniorWeb\Model;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Class BadgeUsageDay.
 */
class BadgeUsageDay
{
    /** @var string */
    private $day;
    /** @var \DateTime */
    private $enter1;
    /** @var \DateTime */
    private $out1;
    /** @var \DateTime */
    private $enter2;
    /** @var \DateTime */
    private $out2;
    /** @var string */
    private $done;
    /** @var string */
    private $plus;

    /**
     * BadgeUsageDay constructor.
     *
     * @param Crawler $row
     */
    public function __construct(Crawler $row)
    {
        $this->parse($row);
    }

    /**
     * @param Crawler $row
     */
    private function parse(Crawler $row)
    {
        $this->day = $row->filter('td')->eq(0)->text();
        $this->enter1 = $this->dateStringToDateTime($row->filter('td')->eq(1)->text());
        $this->out1 = $this->dateStringToDateTime($row->filter('td')->eq(2)->text());
        $this->enter2 = $this->dateStringToDateTime($row->filter('td')->eq(3)->text());
        $this->out2 = $this->dateStringToDateTime($row->filter('td')->eq(4)->text());
        $this->done = $row->filter('td')->eq(10)->text();
        $this->plus = $row->filter('td')->eq(12)->text();
    }

    /**
     * @param string $time
     *
     * @return \DateTime
     */
    private function dateStringToDateTime(string $time)
    {
        if (empty($time)) {
            return null;
        }

        return new \DateTime($time);
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @return \DateTime
     */
    public function getEnter1()
    {
        return $this->enter1;
    }

    /**
     * @return \DateTime
     */
    public function getOut1()
    {
        return $this->out1;
    }

    /**
     * @return \DateTime
     */
    public function getEnter2()
    {
        return $this->enter2;
    }

    /**
     * @return \DateTime
     */
    public function getOut2()
    {
        return $this->out2;
    }

    /**
     * @return string
     */
    public function getDone(): string
    {
        return $this->done;
    }

    /**
     * @return string
     */
    public function getPlus(): string
    {
        return $this->plus;
    }
}
