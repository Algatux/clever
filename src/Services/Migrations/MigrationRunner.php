<?php
declare(strict_types=1);
namespace Clever\Services\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class MigrationRunner
 * @package Clever\Services
 */
class MigrationRunner
{

    /** @var Filesystem */
    private $filesystem;

    /** @var Capsule */
    private $capsule;

    /**
     * MigrationRunner constructor.
     * @param Filesystem $filesystem
     * @param Capsule $capsule
     */
    public function __construct(Filesystem $filesystem, Capsule $capsule)
    {
        $this->filesystem = $filesystem;
        $this->capsule = $capsule;
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
        $this->markMigrationDone($migration);
    }

    /**
     * @param \SplFileInfo $migration
     */
    private function markMigrationDone(\SplFileInfo $migration)
    {
        $this->capsule->table('migrations')->insert([
            ['migration' => str_replace('.php', '' , $migration->getBasename())]
        ]);
    }

}
