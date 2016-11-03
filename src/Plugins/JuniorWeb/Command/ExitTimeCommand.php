<?php

declare(strict_types=1);

namespace Clever\Plugins\JuniorWeb\Command;

use Clever\Command\CleverCommand;
use Clever\Plugins\JuniorWeb\Model\BadgeUsageDay;
use Clever\Plugins\JuniorWeb\Model\User;
use Clever\Plugins\JuniorWeb\Service\Scraper\BadgeUsageDataScraper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ExitTimeCommand.
 */
class ExitTimeCommand extends CleverCommand
{
    /** @var BadgeUsageDataScraper */
    protected $scraper;
    /** @var  User */
    private $user;

    protected function configure()
    {
        $this
            ->setName('juniorweb:data:exit-time')
            ->addArgument('username', InputArgument::REQUIRED, 'juniorWeb username')
            ->addArgument('password', InputArgument::REQUIRED, 'juniorWeb password');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->user = new User($input->getArgument('username'), $input->getArgument('password'));
        $this->scraper = $this->getContainer()->make('juniorweb.badge_data_scraper');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = $this
            ->scraper
            ->getBadgeUsageDataForUser($this->user);

        $collection = array_filter(
            $data->getData(),
            function (BadgeUsageDay $day) {
                if (false !== strpos($day->getDay(), (new \DateTime())->format('d'))) {
                    return true;
                }

                return false;
            }
        );

        if (count($collection) !== 1) {
            throw new \Exception('more than a day matched');
        }

        /** @var BadgeUsageDay $today */
        $today = array_pop($collection);

        $exitAt = $this->calculateExitTime($today);

        $output->writeln("Esci alle: ".$exitAt->format('H:i:m'));
    }

    /**
     * @param BadgeUsageDay $today
     *
     * @return \DateTime
     */
    private function calculateExitTime(BadgeUsageDay $today): \DateTime
    {
        $minutes = 8 * 60;

        $enter1 = $today->getEnter1();
        $out1 = $today->getOut1();

        $enter2 = $today->getEnter2();

        $partial = (((int)$out1->format('H')) * 60 + (int)$out1->format('i')) - (((int)$enter1->format('H')) * 60 + (int)$enter1->format('i'));
        $remainingMinutes = $minutes - $partial;

        $exitAt = clone $enter2;
        $exitAt->add(new \DateInterval('PT'.$remainingMinutes.'M'));

        return $exitAt;
    }
}
