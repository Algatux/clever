<?php

use Clever\Plugins\TorrentScraper\Models\Torrent;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTorrentPluginTorrentscraper
 */
class CreateTorrentPluginTorrentscraper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Torrent::NAME, function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('hash', 40)->unique();
            $table->text('magnetLink')->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Torrent::NAME);
    }

}
