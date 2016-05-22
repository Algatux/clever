<?php
declare(strict_types=1);
namespace Clever\Models\Repository;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class MigrationsRepository
 * @package Clever\Models
 */
class MigrationsRepository
{

    /**
     * @var Capsule
     */
    private $capsule;

    /**
     * MigrationsRepository constructor.
     * @param Capsule $capsule
     */
    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
        $this->table = $capsule->table('migrations');
    }

    /**
     * 
     */
    public function clearMigrations()
    {
        $this->table->truncate();
    }

    /**
     * @param \SplFileInfo $file
     * @return bool
     */
    public function hasMigrationFromSplFileInfo(\SplFileInfo $file): bool
    {
        return $this->hasMigration(
            $this->composeMigrationNameFromSplFileInfo($file)
        );
    }

    /**
     * @param string $sign
     * @return bool
     */
    public function hasMigration(string $sign): bool
    {
        return null !== $this->table
            ->where('migration', '=', $sign)
            ->first();
    }

    /**
     * @param string $sign
     * @return bool
     */
    public function insertMigration(string $sign): bool
    {
        return $this->table->insert([
            ['migration' => $sign]
        ]);
    }

    /**
     * @param \SplFileInfo $file
     * @return bool
     */
    public function insertMigrationFromSplFileInfo(\SplFileInfo $file): bool
    {
        return $this->insertMigration(
            $this->composeMigrationNameFromSplFileInfo($file)
        );
    }

    /**
     * @param \SplFileInfo $file
     * @return string
     */
    public function composeMigrationNameFromSplFileInfo(\SplFileInfo $file): string
    {
        return substr($file->getBasename(), 0, -4);
    }

}