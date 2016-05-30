<?php

namespace Clever\Services\Doctrine;

use Clever\Config\ApplicationConfiguration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

/**
 * Class EntityManagerFactory
 * @package Clever\Services\Doctrine
 */
class EntityManagerFactory
{
    /**
     * @var ApplicationConfiguration
     */
    private $configuration;

    /**
     * EntityManagerFactory constructor.
     * @param ApplicationConfiguration $configuration
     */
    public function __construct(ApplicationConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param bool $devMode
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function createEntityManager($devMode = false)
    {
        $dataBaseConfiguration = $this->configuration->getConfig()->get('database');
        $paths = $this->configuration->getConfig()->get('paths')['entities'];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $devMode, null, null, false);
        
        return EntityManager::create($dataBaseConfiguration, $config);
    }
    
}
