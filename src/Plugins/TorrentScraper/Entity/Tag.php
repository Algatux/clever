<?php

namespace Clever\Plugins\TorrentScraper\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 * @package Clever\Plugins\TorrentScraper\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="torrentscraper_torrent_tag", uniqueConstraints={
 *   @ORM\UniqueConstraint(name="torrentscraper_tag_name", columns={"name"}),
 * })
 */
class Tag
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
     * Torrent constructor.
     */
    public function __construct()
    {
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

}
