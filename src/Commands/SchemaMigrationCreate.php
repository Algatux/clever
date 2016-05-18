<?php
declare(strict_types = 1);
namespace Clever\Commands;

use Clever\Schema\Config;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Migrations\MigrationCreator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SchemaMigrationCreate
 * @package Clever\Commands
 */
class SchemaMigrationCreate extends Command
{
    /** @var Container */
    private $container;

    /** @var MigrationCreator */
    private $migrationCreator;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->container = $container;
        $this->migrationCreator = $container->make('migration.creator');
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('schema:migration:create')
            ->setDescription('creates a new database migration')
            ->addArgument(
                'tableName',
                InputArgument::REQUIRED,
                'Migration target table name'
            )
            ->addOption(
                'targetPlugin',
                'p',
                InputOption::VALUE_REQUIRED,
                'If the migration targets a plugin, specify the plugin name'
            )
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = new Config($input);

        $name = $config->getMigrationName();
        $path = __DIR__;
        
        $output->writeln(sprintf('<info>Creating migration %s</info>', $name));
        
        $this->migrationCreator->create($name, $path, $config->getTableName());
        
    }


}