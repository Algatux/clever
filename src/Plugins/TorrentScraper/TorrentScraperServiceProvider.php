<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper;

use Clever\Plugins\TorrentScraper\Drivers\Kikasstorrents;
use Goutte\Client;
use Illuminate\Support\ServiceProvider;

/**
 * Class TorrentScraperServiceProvider
 * @package Clever\Plugins\TorrentScraper
 */
class TorrentScraperServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('goutte', Client::class);

        $this->app->bind('torrent.scraper', function(){

            $scraper = new Scraper();
            $scraper->addAdapert(new Kikasstorrents($this->app->make('goutte')));

            return $scraper;
        });
    }
}