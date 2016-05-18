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

    /** @var bool */
    private $isNewTable;

    /**
     * Config constructor.
     * @param InputInterface $inputInterface
     */
    public function __construct(InputInterface $inputInterface)
    {
        $this->tableName = $inputInterface->getArgument('tableName');
        $this->targetPlugin = $inputInterface->getOption('targetPlugin');
        $this->isNewTable = $inputInterface->getOption('create');
    }

    /**
     * @return mixed
     */
    public function isNewTable()
    {
        return $this->isNewTable;
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
        $name = [];
        $name[] = $this->isNewTable() ? "create" : "update";
        $name[] = $this->getTableName();
        
        if ($this->hasTargetPlugin()) {
            $name[] = $this->hasTargetPlugin() ? sprintf("plugin_%s",strtolower($this->getTargetPlugin())) : '';
        }

        return implode("_", $name);
    }
    
}
