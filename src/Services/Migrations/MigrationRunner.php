<?php
declare(strict_types=1);
namespace Clever\Services\Migrations;

use Clever\Models\Repository\MigrationsRepository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Filesystem\Filesystem;

/**
 * Class MigrationRunner
 * @package Clever\Services
 */
class MigrationRunner
{

    /** @var Filesystem */
    private $filesystem;
    
    /** @var MigrationsRepository */
    private $migrationsRepository;

    /**
     * MigrationRunner constructor.
     * @param Filesystem $filesystem
     * @param MigrationsRepository $migrationsRepository
     */
    public function __construct(
        Filesystem $filesystem,
        MigrationsRepository $migrationsRepository
    )
    {
        $this->filesystem = $filesystem;
        $this->migrationsRepository = $migrationsRepository;
    }

    /**
     * @param \SplFileInfo $migration
     * @param bool $force
     */
    public function runMigration(\SplFileInfo $migration, bool $force = false)
    {
        $this->filesystem->requireOnce($migration->getPathname());
        $classes = get_declared_classes();
        $class = end($classes);
        /** @var Migration $migrationInstance */
        $migrationInstance = new $class;

        if ($force) {
            $migrationInstance->down();
        }
        $migrationInstance->up();
        $this->markMigrationDone($migration);
    }

    /**
     * @param \SplFileInfo $migration
     */
    private function markMigrationDone(\SplFileInfo $migration)
    {
        $this->migrationsRepository
            ->insertMigrationFromSplFileInfo($migration);
    }

}
