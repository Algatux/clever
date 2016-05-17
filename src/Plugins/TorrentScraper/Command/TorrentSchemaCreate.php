<?php
declare(strict_types = 1);
namespace Clever\Plugins\TorrentScraper\Command;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TorrentSchemaCreate
 * @package Clever\Plugins\TorrentScraper\Command
 */
class TorrentSchemaCreate extends Command
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Clever constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    /**
     * Configuration
     */
    protected function configure()
    {
        $this
            ->setName('torrent:schema:create')
            ->setDescription('creates database schema')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating schemas');
    }

}
