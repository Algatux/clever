<?php

namespace Clever\ServiceProviders;

use Clever\CleverApplication;
use Clever\Command\Clever;
use Clever\Command\Scraper;
use Clever\Plugins\TorrentScraper\Command\TorrentScraper;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Application;

/**
 * Class ConsoleProvider
 * @package Clever\ServiceProviders
 */
class ConsoleProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('clever.app', function() {
            
            return new Application(CleverApplication::NAME,CleverApplication::VERSION);
        });
        
    }

}
