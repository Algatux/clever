<?php

declare(strict_types = 1);

namespace CleverTest\functional;

use Clever\Plugins\TorrentScraper\Entity\Tag;
use Clever\Plugins\TorrentScraper\Entity\Torrent;

class TestTest extends CleverTestcase
{

    public function test_doctrine_entity()
    {

        $torrent = new Torrent();
        $torrent->setName('test');
        $torrent->setMagnetLink('823yuadbfbvubad');
        
        $tag1 = new Tag();
        $tag1->setName('tag1');

        $tag2 = new Tag();
        $tag2->setName('tag2');

        $tag3 = new Tag();
        $tag3->setName('tag3');

        $torrent->addTag($tag1);
        $torrent->addTag($tag2);
        $torrent->addTag($tag3);

        $this->entityManger()->persist($torrent);
        $this->entityManger()->flush($torrent);

        $torrent1 = new Torrent();
        $torrent1->setName('test1');
        $torrent1->setMagnetLink('823yuadbfbvubad1');

        $torrent1->addTag($tag1);

        $this->entityManger()->persist($torrent1);
        $this->entityManger()->flush($torrent1);

        dump($torrent1);
    }

}
