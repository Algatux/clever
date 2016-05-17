<?php
declare(strict_types = 1);
namespace Clever\Plugins\TorrentScraper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{

    use SoftDeletes;

    protected $table = 'torrent_tags';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function torrents()
    {
        return $this->belongsTo(Torrent::class);
    }

}