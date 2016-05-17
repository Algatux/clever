<?php
declare(strict_types = 1);
namespace Clever\Plugins\TorrentScraper\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Torrent extends Model
{
    const NAME = 'torrent';

    use SoftDeletes;

    /** @var string  */
    protected $table = self::NAME;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    
}
