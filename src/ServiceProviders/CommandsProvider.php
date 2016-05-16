<?php

namespace Clever\ServiceProviders;

use Clever\CleverApplication;
use Clever\Command\Clever;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Application;

/**
 * Class CommandsProvider
 * @package Clever\ServiceProviders
 */
class CommandsProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('clever.app', function() {
            $app = new Application(CleverApplication::NAME,CleverApplication::VERSION);
            $app->add(new Clever($this->app, $this->app['config']));

            return $app;
        });
        
    }

}
