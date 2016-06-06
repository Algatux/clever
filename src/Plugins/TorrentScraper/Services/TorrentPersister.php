<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;

use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TorrentPersister
 * @package Clever\Plugins\TorrentScraper\Services
 */
class TorrentPersister
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * TorrentPersister constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Torrent $torrent
     * @return bool
     * @throws \Exception
     */
    public function persistNewtorrent(Torrent $torrent): bool
    {
        $existantTorrent = $this->entityManager->getRepository(Torrent::class)->findOneBy([
            "magnetLink" => $torrent->getMagnetLink()
        ]);

        if (null !== $existantTorrent) {
            return false;
        }

        try {
            $this->entityManager->persist($torrent);
            $this->entityManager->flush($torrent);
            return true;
        }catch (\Exception $e) {
            throw $e;
        }
    }
    
}
