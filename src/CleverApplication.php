<?php

declare(strict_types = 1);

namespace Clever;

use Clever\Config\ServiceProviders;
use Clever\Exceptions\Services\ProviderClassNotFound;
use Clever\Exceptions\Services\UnexpectedClassFound;
use Clever\Providers\CleverServiceProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Container\Container;

/**
 * Class CleverApplication
 */
final class CleverApplication extends Container
{
    const VERSION = '0.1';
    const NAME = 'Clever';
    const APP_SERVICE_NAME = 'clever.console';
    private $serviceProviders;

    /**
     * CleverApplication constructor.
     */
    public function __construct()
    {
        self::setInstance($this);
        $this->instance(Container::class, $this);
        $this->serviceProviders = new ArrayCollection();
    }

    /**
     * @return CleverApplication|$this
     *
     * @throws UnexpectedClassFound
     */
    public function bootstrap(): CleverApplication
    {
        $this->registerServiceProviders();

        return $this;
    }

    /**
     * Fills the container with ServiceProviders provided classnames
     */
    protected function registerServiceProviders()
    {
        $this->serviceProviders = new ArrayCollection(
            array_map(
                function (string $provider) {

                    if (!class_exists($provider, true)) {
                        throw new ProviderClassNotFound(sprintf("Provider Class %s does not exist", $provider));
                    }

                    if (!is_subclass_of($provider, CleverServiceProvider::class, true)) {
                        throw new UnexpectedClassFound(
                            sprintf("Class %s it is not a CleverServiceProvider", $provider)
                        );
                    }

                    /** @var CleverServiceProvider $providerInstance */
                    $providerInstance = new $provider($this);
                    $providerInstance->registerParameters();
                    $providerInstance->registerServices();
                    $providerInstance->registerConsoleCommands();

                    return $provider;
                },
                ServiceProviders::getRegisteredServices()
            )
        );
    }

    /**
     * @return ArrayCollection|CleverServiceProvider[]
     */
    public function getServiceProviders(): ArrayCollection
    {
        return $this->serviceProviders;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->make(EntityManagerInterface::class);
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->make(CleverApplication::APP_SERVICE_NAME)->run();
    }
}
