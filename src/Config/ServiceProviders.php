<?php

declare(strict_types = 1);

namespace Clever\Config;

use Clever\Plugins\TorrentScraper\TorrentScraperServiceProvider;
use Clever\Providers\ApplicationProvider;
use Clever\Providers\ConsoleProvider;

/**
 * Class ServiceProviders
 */
class ServiceProviders
{
    /** @var array */
    private static $services = [

        // Clever Service Providers
        ApplicationProvider::class,
        ConsoleProvider::class,

        // Plugins provider
    ];

    /**
     * @return array
     */
    public static function getRegisteredServices(): array
    {
        return static::$services;
    }
}
