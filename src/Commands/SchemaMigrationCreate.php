<?php
declare(strict_types = 1);
namespace Clever\Commands;

use Clever\Config\ApplicationConfiguration;
use Clever\Schema\Config;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
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

    /** @var MigrationCreator */
    private $migrationCreator;

    /** @var Filesystem */
    private $filesystem;

    /** @var ApplicationConfiguration */
    private $cleverConfig;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->migrationCreator = $container->make(MigrationCreator::class);
        $this->filesystem = $container->make(Filesystem::class);
        $this->cleverConfig = $container->make(ApplicationConfiguration::class);
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('migration:create')
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
            ->addOption(
                'create',
                'c',
                InputOption::VALUE_NONE,
                'Is a new table ?'
            );
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
        $path = $this->composeMigrationTargetDir($config);

        // Not sure about creating the directory
//        if (! $this->filesystem->exists($path)) {
//            $this->filesystem->makeDirectory($path);
//        }

        $output->writeln(sprintf('<info>Creating migration %s</info>', $name));

        $this->migrationCreator->create($name, $path, $config->getTableName(), $config->isNewTable());
    }

    protected function composeMigrationTargetDir(Config $config)
    {
        $appConfig = $this->cleverConfig->getConfig();

        if (
            $config->hasTargetPlugin() &&
            !$this->filesystem->exists($appConfig->get('plugins')['dir'] . "/" . $config->getTargetPlugin())
        ) {
            throw new InvalidArgumentException('Provided Plugin not found');
        }

        if ($config->hasTargetPlugin()) {
            return $appConfig->get('plugins')['dir'] .
            "/" . $config->getTargetPlugin() .
            $appConfig->get('database')['migrations-dir'];
        }

        return __DIR__ . "/.." . $appConfig->get('database')['migrations-dir'];
    }

}