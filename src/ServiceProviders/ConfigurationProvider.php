<?php

namespace Clever\ServiceProviders;
use Clever\Config\ApplicationConfiguration;
use Illuminate\Support\ServiceProvider;

/**
 * Class ConfigurationProvider
 * @package Clever\ServiceProviders
 */
class ConfigurationProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return array
     */
    public function register()
    {
        $this->app->singleton('config', ApplicationConfiguration::class);
    }

}
