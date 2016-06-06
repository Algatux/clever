<?php

declare(strict_types=1);

namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Command\TorrentScraper;
use Clever\Plugins\TorrentScraper\Drivers\Kikasstorrents;
use Clever\Plugins\TorrentScraper\Services\TorrentMapper;
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
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Goutte::class, Goutte::class);

        $this->app->bind(Scraper::class, function(){
            $scraper = new Scraper($this->app->make(TorrentMapper::class));
            $scraper->addDriver(new Kikasstorrents($this->app->make(Goutte::class)));

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
        $clever = $this->app->make('clever.app');
        $clever->add(new TorrentScraper($this->app));
    }
}