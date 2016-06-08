<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     name="torrentscraper_torrent_tag",
 *     indexes={
 *          @ORM\Index(name="tag_family_name", columns={"family","name"}),
 *          @ORM\Index(name="tag_name", columns={"name"})
 *     },
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(name="torrentscraper_tag_name", columns={"name"}),
 *     }
 * )
 */
final class Tag
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name", length=10)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", name="family", length=10)
     */
    private $family;

    /**
     * @var ArrayCollection|Torrent[]
     * @ORM\ManyToMany(targetEntity="Torrent", mappedBy="tags")
     */
    private $torrents;

    /**
     * Torrent constructor.
     */
    public function __construct()
    {
        $this->torrents = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * @param string $family
     */
    public function setFamily(string $family)
    {
        $this->family = $family;
    }

    /**
     * @return ArrayCollection|Torrent[]
     */
    public function getTorrents(): ArrayCollection
    {
        return $this->torrents;
    }

    /**
     * @param ArrayCollection $torrents
     */
    public function setTorrents(ArrayCollection $torrents)
    {
        $this->torrents = $torrents;
    }

    /**
     * @param Torrent $torrent
     */
    public function addTorrent(Torrent $torrent)
    {
        if (!$this->torrents->contains($torrent)) {
            $this->torrents->add($torrent);
            $torrent->addTag($this);
        }
    }

}
