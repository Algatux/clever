<?php
declare(strict_types = 1);
namespace Clever\Commands;

use Clever\Models\Repository\MigrationsRepository;
use Clever\Services\Migrations\MigrationFinder;
use Clever\Services\Migrations\MigrationRunner;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SchemaMigrationRun
 * @package Clever\Commands
 */
class SchemaMigrationRun extends Command
{

    /** @var MigrationFinder  */
    private $finder;

    /** @var MigrationRunner */
    private $runner;

    /** @var \Clever\Models\Repository\MigrationsRepository */
    private $migrations;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->runner = $container->make(MigrationRunner::class);
        $this->finder = $container->make(MigrationFinder::class);
        $this->migrations = $container->make(MigrationsRepository::class);
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('migration:run')
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


        if ($force) {
            $this->migrations->clearMigrations();
        }

        foreach ($migrations as $migration) {
            if (! $this->migrations->hasMigrationFromSplFileInfo($migration)) {
                $output->writeln(sprintf('<info>Running migration: %s</info>', $migration->getFilename()));
                $this->runner->runMigration($migration, $force);
            }
        }

        $output->writeln('<info>Done!</info>');
    }

    

}