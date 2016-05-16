<?php
declare(strict_types=1);
namespace Clever\Config;

use Clever\ServiceProviders\CommandsProvider;
use Clever\ServiceProviders\ConfigurationProvider;

/**
 * Class ServiceProviders
 * @package Clever\Config
 */
class ServiceProviders
{

    /** @var array  */
    private static $services = [
        ConfigurationProvider::class,
        CommandsProvider::class,
    ];

    /**
     * @return array
     */
    public static function getRegisteredServices(): array
    {
        return self::$services;
    }

}
