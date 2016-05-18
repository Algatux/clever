<?php
declare(strict_types = 1);
namespace Clever\Commands;

use Clever\Config\ApplicationConfiguration;
use Clever\Services\MigrationFinder;
use Clever\Services\MigrationRunner;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

/**
 * Class SchemaMigrationRun
 * @package Clever\Commands
 */
class SchemaMigrationRun extends Command
{
    /** @var Container */
    private $container;

    /** @var MigrationFinder  */
    private $finder;

    /** @var MigrationRunner */
    private $runner;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->container = $container;
        $this->runner = $container->make('migration.runner');
        $this->finder = $container->make('migration.finder');
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('schema:migration:run')
            ->setDescription('runs migrations')
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'force migration rerun! Be carefull, this will delete all your data!'
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
        $force = $input->getOption('force');

        $output->writeln('<info>Searching for Migrations</info>');

        $migrations = $this->finder->findMigrations();

        $output->writeln(sprintf('<info>Found %d migrations</info>', count($migrations)));

        foreach ($migrations as $migration) {
            $output->writeln(sprintf('<info>Running migration: %s</info>', $migration->getFilename()));

            $this->runner->runMigrations($migration, $force);
        }

        $output->writeln('<info>Done!</info>');
    }

    

}