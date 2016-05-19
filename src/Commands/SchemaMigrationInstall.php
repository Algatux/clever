<?php
declare(strict_types = 1);
namespace Clever\Commands;

use Clever\Services\Migrations\MigrationInstaller;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SchemaMigrationRun
 * @package Clever\Commands
 */
class SchemaMigrationInstall extends Command
{

    /** @var MigrationInstaller */
    private $installer;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->installer = $container->make(MigrationInstaller::class);
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('migration:install')
            ->setDescription('installs migrations table')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln('<info>Creating migration table</info>');
        
        $this->installer->install();

        $output->writeln('<info>Done!</info>');
    }

    

}