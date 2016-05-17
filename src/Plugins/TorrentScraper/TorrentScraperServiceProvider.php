<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper;

use Clever\Contracts\HasDatabaseSchema;
use Clever\Plugins\TorrentScraper\Command\TorrentScraper;
use Clever\Plugins\TorrentScraper\Drivers\Kikasstorrents;
use Clever\Plugins\TorrentScraper\Models\Torrent;
use Clever\Plugins\TorrentScraper\Services\ResultBuilder;
use Goutte\Client;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Application;

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
        $this->app->bind('torrent.goutte', Client::class);

        $this->app->bind('torrent.scraper', function(){
            $scraper = new Scraper();
            $scraper->addAdapert(new Kikasstorrents($this->app->make('torrent.goutte')));

            return $scraper;
        });

        $this->app->bind('torrent.result_builder', ResultBuilder::class);

        /** @var Application $clever */
        $clever = $this->app->make('clever.app');
        $clever->add(new TorrentScraper($this->app));
    }

}