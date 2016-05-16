<?php

namespace Clever\Command;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Scraper
 * @package Clever\Command
 */
class Scraper extends Command
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
            ->setName('scrape')
            ->setDescription('Greet someone')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Scraping');

        $this->container->make('torrent.scraper')->scrape(['query'=>'supergirl 720p']);

        $output->writeln('End');
    }

}