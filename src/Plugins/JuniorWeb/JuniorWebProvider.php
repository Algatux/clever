<?php

declare(strict_types = 1);

namespace Clever\Plugins\JuniorWeb;

use Clever\Plugins\JuniorWeb\Command\ExitTimeCommand;
use Clever\Plugins\JuniorWeb\Service\Scraper\BadgeUsageDataScraper;
use Clever\Providers\CleverServiceProvider;
use Goutte\Client;

/**
 * Class JuniorWebProvider.
 */
class JuniorWebProvider extends CleverServiceProvider
{
    /**
     * Register Parameters.
     */
    public function registerParameters()
    {
        $this->container->bind('juniorweb.address', function(){
            return 'http://172.27.0.42:90'; // SERVER ADDRESS & PORT
        });
    }

    /**
     * Register Services.
     */
    public function registerServices()
    {
        $this->container->bind(BadgeUsageDataScraper::class, function(){
            return new BadgeUsageDataScraper(
                new Client(),
                $this->container->make('juniorweb.address')
            );
        });
    }

    /**
     * Register the console commands.
     */
    public function registerConsoleCommands()
    {
        $this->clever()
            ->add(new ExitTimeCommand($this->container));
    }
}
