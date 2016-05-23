<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Models\Repository;

use Clever\Plugins\TorrentScraper\Models\Torrent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TorrentRepository
 * @package Clever\Plugins\TorrentScraper\Models\Repository
 */
class TorrentRepository
{

    /**
     * @var Torrent
     */
    private $table;

    /**
     * TorrentRepository constructor.
     * @param Torrent|Model $table
     */
    public function __construct(Torrent $table)
    {
        $this->table = $table->newQuery();
    }

    /**
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|Model
     */
    public function findTorrentById(int $id)
    {
        return $this->table->find($id);
    }

    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findTorrentByName(string $name)
    {
        return $this->table->where('name', '=', $name)->get();
    }

    /**
     * @param string $hash
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findTorrentByHash(string $hash)
    {
        return $this->table->where('hash', '=', $hash)->get();
    }

    /**
     * @param string $magnet
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findTorrentByMagnet(string $magnet)
    {
        return $this->table->where('magnetLink', '=', $magnet)->get();
    }

}
