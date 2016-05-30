<?php

namespace Clever\Plugins\TorrentScraper\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Torrent
 * @package Clever\Plugins\TorrentScraper\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="torrentscraper_torrent", uniqueConstraints={
 *   @ORM\UniqueConstraint(name="torrentscraper_torrent_magnet_link", columns={"magnet_link"}),
 * })
 */
class Torrent
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="text", name="magnet_link")
     */
    private $magnetLink;

    /**
     * @var int
     * @ORM\Column(name="seeders", type="smallint", options={"unsigned"=true}, nullable=true)
     */
    private $seeders;

    /**
     * @var int
     * @ORM\Column(name="leechers", type="smallint", options={"unsigned"=true}, nullable=true)
     */
    private $leechers;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"}, orphanRemoval=true)
     * @ORM\JoinTable(name="torrents_tags",
     *      joinColumns={@ORM\JoinColumn(name="torrent_id", referencedColumnName="id")},
     *      inverseJoinColumns={@Orm\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    /**
     * Torrent constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId(): integer
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(integer $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMagnetLink(): string
    {
        return $this->magnetLink;
    }

    /**
     * @param string $magnetLink
     */
    public function setMagnetLink(string $magnetLink)
    {
        $this->magnetLink = $magnetLink;
    }

    /**
     * @return int
     */
    public function getSeeders(): integer
    {
        return $this->seeders;
    }

    /**
     * @param int $seeders
     */
    public function setSeeders(integer $seeders)
    {
        $this->seeders = $seeders;
    }

    /**
     * @return int
     */
    public function getLeechers(): integer
    {
        return $this->leechers;
    }

    /**
     * @param int $leechers
     */
    public function setLeechers(integer $leechers)
    {
        $this->leechers = $leechers;
    }

    /**
     * @return mixed
     */
    public function getTags(): ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if(! $this->tags->contains($tag)){
            $this->tags->add($tag);
        }
    }

}
