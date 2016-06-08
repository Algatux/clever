<?php

declare(strict_types = 1);

namespace CleverTest\functional;

use Clever\CleverApplication;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CleverTestcase
 * @package CleverTest\functional
 */
class CleverTestcase extends \PHPUnit_Framework_TestCase
{

    /** @var CleverApplication */
    protected $container;

    /** @var  EntityManagerInterface */
    protected $entityManger;

    public function setUp()
    {
        $this->container = new CleverApplication();
        $this->entityManger = $this->container->make(EntityManagerInterface::class);
        $this->entityManger->beginTransaction();
    }

    public function tearDown()
    {
        $this->entityManger->rollback();
        $this->container = null;
    }

    /**
     * @return CleverApplication
     */
    public function app(): CleverApplication
    {
        return $this->container;
    }

    /**
     * @return EntityManagerInterface
     */
    public function entityManger(): EntityManagerInterface
    {
        return $this->entityManger;
    }

}