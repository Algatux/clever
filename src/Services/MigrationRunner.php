<?php
declare(strict_types=1);
namespace Clever\Services;

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

    /**
     * MigrationRunner constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param \SplFileInfo $migration
     * @param bool $force
     */
    public function runMigrations(\SplFileInfo $migration, bool $force = false)
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
    }

}
