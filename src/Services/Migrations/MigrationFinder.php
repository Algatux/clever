<?php
declare(strict_types=1);
namespace Clever\Services\Migrations;

use Clever\Config\ApplicationConfiguration;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;

/**
 * Class MigrationFinder
 * @package Clever\Services
 */
class MigrationFinder
{

    /**
     * @var Finder
     */
    private $finder;
    /**
     * @var ApplicationConfiguration
     */
    private $configuration;

    /**
     * MigrationFinder constructor.
     * @param Finder $finder
     * @param ApplicationConfiguration $configuration
     */
    public function __construct(Finder $finder, ApplicationConfiguration $configuration)
    {
        $this->finder = $finder;
        $this->configuration = $configuration;
    }

    /**
     * @return Collection
     */
    public function findMigrations(): Collection
    {
        $migrationDirs = $this->obtainMigrationDirs();
        $migrations = $this->findMigrationsFiles($migrationDirs);

        return  $this->cleanFoundMigrations($migrations);
    }

    /**
     * @param array $migrationsDirs
     * @return Finder
     */
    private function findMigrationsFiles(array $migrationsDirs): Finder
    {
        return $this->finder
            ->files()
            ->ignoreDotFiles(true)
            ->ignoreVCS(true)
            ->in($migrationsDirs)
            ->depth('==0')
            ->sortByName();
    }

    /**
     * @param Finder $migrations
     * @return Collection|\SplFileInfo[]
     */
    private function cleanFoundMigrations(Finder $migrations): Collection
    {
        $collection =  new Collection();
        foreach ($migrations as $migration) {
            $collection->push($migration);
        }

        return $collection;
    }

    /**
     * @return array
     */
    private function obtainMigrationDirs(): array
    {
        $appConfig = $this->configuration->getConfig();
        $migrationDirName = $appConfig->get('database')['migrations-dir'];

        $migrationDirs = [
            CLEVER_ROOT_DIR . $migrationDirName,
            $appConfig->get('plugins')['dir'] . "/*" . $migrationDirName
        ];

        return $migrationDirs;
    }

}
