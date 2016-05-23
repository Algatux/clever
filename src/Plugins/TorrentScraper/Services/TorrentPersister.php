<?php
declare(strict_types=1);
namespace Clever\Plugins\TorrentScraper\Services;
use Clever\Plugins\TorrentScraper\Models\Torrent;
use Illuminate\Database\QueryException;

/**
 * Class TorrentPersister
 * @package Clever\Plugins\TorrentScraper\Services
 */
class TorrentPersister
{

    /**
     * TorrentPersister constructor.
     */
    public function __construct()
    {}

    /**
     * @param Torrent $torrent
     * @return bool
     */
    public function insertModel(Torrent $torrent): bool
    {

        try {
            $torrent->save();

            return true;
        }catch (QueryException $e) {
            if (! preg_match('/UNIQUE constraint/', $e->getMessage())) {
                throw $e;
            }
        }

        return false;
    }
    
}
