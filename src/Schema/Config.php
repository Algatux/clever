<?php
declare(strict_types = 1);
namespace Clever\Schema;

use Symfony\Component\Console\Input\InputInterface;

/**
 * Class Config
 * @package Clever\Schema
 */
class Config
{

    /** @var string */
    private $tableName;

    /** @var string|null */
    private $targetPlugin;

    /**
     * Config constructor.
     * @param InputInterface $inputInterface
     */
    public function __construct(InputInterface $inputInterface)
    {
        $this->tableName = $inputInterface->getArgument('tableName');
        $this->targetPlugin = $inputInterface->getOption('targetPlugin');
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @return string
     */
    public function getTargetPlugin(): string
    {
        return $this->targetPlugin ? $this->targetPlugin : '';
    }

    /**
     * @return bool
     */
    public function hasTargetPlugin(): bool
    {
        return null !== $this->targetPlugin;
    }

    /**
     * @return string
     */
    public function getMigrationName(): string
    {
        $name = $this->getTableName();
        $name .= $this->hasTargetPlugin() ? "_" . strtolower($this->getTargetPlugin()) : '';

        return $name;
    }
    
}
