<?php
declare(strict_types=1);
namespace Clever\ServiceProviders;

use Clever\Config\ApplicationConfiguration;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class ApplicationProvider
 * @package Clever\ServiceProviders
 */
class ApplicationProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('capsule', function() {
            /** @var ApplicationConfiguration $databaseConfig */
            $databaseConfig = $this->app['config'];
            $capsule = new Capsule();

            $capsule->addConnection(
                $databaseConfig
                    ->getConfig()
                    ->get('database')
            );

            $capsule->setAsGlobal();

            return $capsule;
        });
    }
}