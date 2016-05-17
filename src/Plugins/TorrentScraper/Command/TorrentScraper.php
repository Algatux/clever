<?php
declare(strict_types = 1);
namespace Clever\Plugins\TorrentScraper\Command;

use Clever\Plugins\TorrentScraper\Config\Config;
use Clever\Plugins\TorrentScraper\Scraper;
use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TorrentScraper
 * @package Clever\Plugins\TorrentScraper\Command
 */
class TorrentScraper extends Command
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
            ->setName('torrent:search')
            ->setDescription('searches for a torrent')
            ->addArgument(
                'query',
                InputArgument::REQUIRED,
                'What are you searching for?'
            )
            ->addOption(
                'driver',
                'd',
                InputOption::VALUE_REQUIRED,
                'Use specific driver'
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

        if (null === $config->getQuery()) {
            $output->writeln('<error>Please specify a search query string</error>');
            return 1;
        }

        $output->writeln(sprintf('<info>Start Scraping for: %s</info>', $config->getQuery()));

        /** @var Scraper $scraper */
        $scraper = $this->container->make('torrent.scraper');
        $scraper->scrape($config);

        $output->writeln('End');

        return 0;
    }


}
