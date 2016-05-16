<?php

namespace Clever;

use Clever\ServiceProviders\CommandsProvider;
use Clever\ServiceProviders\ConfigurationProvider;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * Class Application
 * @package Clever
 */
class Application extends Container {

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->registerBaseBindings();
        $this->registerServiceProviders();
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        self::setInstance($this);
        $this->instance('app', $this);
        $this->instance('Illuminate\Container\Container', $this);
    }

    protected function registerServiceProviders()
    {
        $serviceProviders = $this->listServiceProviders();

        foreach ($serviceProviders as $provider) {
            /** @var ServiceProvider $provider */
            $provider = new $provider($this);
            $provider->register();
        }
    }

    private function listServiceProviders()
    {
        return [
            ConfigurationProvider::class,
            CommandsProvider::class,
        ];
    }
    
}
