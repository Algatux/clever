<?php
declare(strict_types = 1);
namespace Clever\Plugins\TorrentScraper\Command;

use Clever\Plugins\TorrentScraper\Config\Config;
use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Clever\Plugins\TorrentScraper\Scraper;
use Clever\Plugins\TorrentScraper\Services\TorrentPersister;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
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
        $newTorrents = 0;
        $skippedTorrents = 0;

        $output->writeln(sprintf('<info>Start Scraping for: %s</info>', $config->getQuery()));

        /** @var Scraper $scraper */
        $scraper = $this->container->make(Scraper::class);
        $results = $scraper->scrape($config);

        $output->writeln(sprintf('<info>Found results: %d</info>', $results->count()));

        /** @var TorrentPersister $persister */
        $persister = $this->container->make(TorrentPersister::class);

        /** @var Torrent $result */
        foreach ($results as $result) {
            try{
                $insertResult = $persister->persistNewtorrent($result);
                $newTorrents += $insertResult ? 1: 0;
                $skippedTorrents += !$insertResult ? 1: 0;
            }catch (\Exception $e){
                $output->writeln($e->getMessage());
            }
        }

        $output->writeln(sprintf('<info>Imported %d new results!</info>', $newTorrents));
        $output->writeln(sprintf('<info>Skipped %d results!</info>', $skippedTorrents));

        $output->writeln('End');

        return 0;
    }


}
