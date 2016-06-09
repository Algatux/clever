<?php

declare(strict_types=1);

namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Command\TorrentScraper;
use Clever\Plugins\TorrentScraper\Drivers\Kikasstorrents;
use Clever\Plugins\TorrentScraper\Services\Mappers\TorrentMapper;
use Clever\Providers\CleverServiceProvider;
use Goutte\Client as Goutte;
use Symfony\Component\Console\Application;

/**
 * Class TorrentScraperServiceProvider
 * @package Clever\Plugins\TorrentScraper
 */
class TorrentScraperServiceProvider extends CleverServiceProvider
{

    /**
     * Register Parameters
     *
     * @return void
     */
    public function registerParameters()
    {
        // TODO: Implement registerParameters() method.
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function registerServices()
    {
        $this->container->bind(Goutte::class, Goutte::class);

        $this->container->bind(Scraper::class, function(){
            $scraper = new Scraper($this->container->make(TorrentMapper::class));
            $scraper->addDriver(new Kikasstorrents($this->container->make(Goutte::class)));

            return $scraper;
        });
    }

    /**
     * Register the console commands
     *
     * @return void
     */
    public function registerConsoleCommands()
    {
        /** @var Application $clever */
        $clever = $this->container->make('clever.app');
        $clever->add(new TorrentScraper($this->container));
    }
}