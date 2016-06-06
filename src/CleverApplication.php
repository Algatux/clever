<?php

namespace Clever;

use Clever\Config\ServiceProviders;
use Clever\Exceptions\Services\UnexpectedClassFound;
use Clever\Providers\CleverServiceProvider;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Container\Container;

define('CLEVER_ROOT_DIR', __DIR__ . "/..");

/**
 * Class CleverApplication
 * @package Clever
 */
class CleverApplication extends Container {

    const VERSION = '0.1';
    const NAME = 'Clever';

    /**
     * CleverApplication constructor.
     */
    public function __construct()
    {
        self::setInstance($this);
        $this->instance(Container::class, $this);

        $this->registerServiceProviders();
    }

    /**
     * Fills the container with ServiceProviders provided classnames
     */
    protected function registerServiceProviders()
    {
        $serviceProviders = ServiceProviders::getRegisteredServices();

        foreach ($serviceProviders as $provider) {

            /** @var CleverServiceProvider $provider */
            $provider = new $provider($this);

            if (! $provider instanceOf CleverServiceProvider) {
                throw new UnexpectedClassFound(sprintf("Class %s it's not a CleverServiceProvider", get_class($provider)));
            }
            
            $provider->register();
            $provider->registerConsoleCommands();
        }
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->make(EntityManagerInterface::class);
    }
    
    /**
     * @return void
     */
    public function run()
    {
        $this->make('clever.app')->run();
    }
    
}
