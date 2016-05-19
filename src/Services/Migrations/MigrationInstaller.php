<?php
declare(strict_types=1);
namespace Clever\Services\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class MigrationInstaller
 * @package Clever\Services\Migrations
 */
class MigrationInstaller
{

    const TABLE_NAME = 'migrations';

    /**
     * MigrationInstaller constructor.
     */
    public function __construct()
    {}

    /**
     * @throws \Exception
     */
    public function install(): bool
    {

        if (Schema::hasTable(self::TABLE_NAME)) {
            throw new \Exception('Migration table exists');
        }

        Schema::create(self::TABLE_NAME, function(Blueprint $table){

            $table->string('migration')->primary();

        });

        return true;
    }

}
