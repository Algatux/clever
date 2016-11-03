<?php

declare(strict_types = 1);

namespace Clever\Plugins\JuniorWeb\Service\Scraper;

use Clever\Plugins\JuniorWeb\Model\BadgeUsageTableMap;
use Clever\Plugins\JuniorWeb\Model\User;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class BadgeUsageDataScraper.
 */
class BadgeUsageDataScraper extends AbstractScraper
{
    /**
     * @param User $user
     *
     * @return BadgeUsageTableMap
     */
    public function getBadgeUsageDataForUser(User $user)
    {
        $mainPage = $this->doLogin($user->getUsername(), $user->getPassword());
        $usagePage = $this->goToBadgeUsagePage($mainPage);

        $table = $usagePage->filter('table')->eq(0);

        return new BadgeUsageTableMap($table);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return Crawler
     * @throws \Exception
     */
    private function doLogin(string $username, string $password): Crawler
    {
        $loginPageCrawler = $this->getUrl(self::BASE_URL);
        $form = $loginPageCrawler->selectButton('Entra')->form();

        $form['user'] = $username;
        $form['psw'] = $password;

        $loggedIn = $this->getClient()->submit($form);

        if (false === strpos($loggedIn->text(), sprintf('JuniorWEB - Account: %s', $username))) {
            throw new \Exception(sprintf('Login Failed with username: %s and password: %s', $username, $password));
        }

        return $loggedIn;
    }

    /**
     * @param Crawler $crawler
     *
     * @return Crawler
     */
    private function goToBadgeUsagePage(Crawler $crawler): Crawler
    {
        $button = $crawler->selectButton('Cartellino');
        $pageUrl = $button->attr('onclick');

        $pageUrl = str_replace(['location.href=','\''],'', $pageUrl);

        return $this->getUrl(self::BASE_URL.$pageUrl);
    }
}
