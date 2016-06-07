<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;
use Clever\Plugins\TorrentScraper\Entity\Tag;
use Clever\Plugins\TorrentScraper\Entity\Torrent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TorrentTagsDecorator
 * @package Clever\Plugins\TorrentScraper\Services
 */
class TorrentTagsDecorator
{

    /**
     * @var TorrentRiddler
     */
    private $riddler;
    /**
     * @var TagMapper
     */
    private $tagMapper;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * TorrentTagsDecorator constructor.
     * @param TorrentRiddler $riddler
     * @param TagMapper $tagMapper
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        TorrentRiddler $riddler,
        TagMapper $tagMapper,
        EntityManagerInterface $entityManager
    )
    {
        $this->riddler = $riddler;
        $this->tagMapper = $tagMapper;
        $this->entityManager = $entityManager;
    }

    /**ù
     * @param Torrent $torrent
     * @return Torrent
     */
    public function decorateTorrentWithTags(Torrent $torrent): Torrent
    {
        $repo = $this->entityManager->getRepository(Tag::class);

        $tags = $this->riddler->findMatchingTags($torrent);

        foreach ($tags as $tagDefinition) {
            /** @var Tag $tagFound */
            $tagFound = $repo->findOneBy([
                "name" => $tagDefinition
            ]);

            if (!$tagFound instanceof Tag) {
                $tagFound = $this->tagMapper
                    ->fromTagDefinitionToTag($tagDefinition);
            }

            //$tagFound->addTorrent($torrent);
            $torrent->addTag($tagFound);
        }

        return $torrent;
    }
    
}
