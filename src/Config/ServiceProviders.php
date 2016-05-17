<?php
declare(strict_types=1);
namespace Clever\Config;

use Clever\Plugins\TorrentScraper\TorrentScraperServiceProvider;
use Clever\Providers\ApplicationProvider;
use Clever\Providers\ConfigurationProvider;
use Clever\Providers\ConsoleProvider;

/**
 * Class ServiceProviders
 * @package Clever\Config
 */
class ServiceProviders
{

    /** @var array  */
    private static $services = [
        ConfigurationProvider::class,
        ApplicationProvider::class,
        ConsoleProvider::class,

        TorrentScraperServiceProvider::class,
    ];

    /**
     * @return array
     */
    public static function getRegisteredServices(): array
    {
        return self::$services;
    }

}
