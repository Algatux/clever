<?php

declare(strict_types = 1);

namespace Clever\Plugins\TorrentScraper\Services\Definitions;

/**
 * Class TagDefinitions
 */
class TagDefinitions
{

    /**
     * @return array
     */
    public function getResolutionDefinitions(): array
    {
        return [
            '1080i',
            '1080p',
            '720p',
            '720i',
            'hr',
            '576p',
            '480p',
            '368p',
            '360p',
        ];
    }

    /**
     * @return array
     */
    public function getSourceDefinitions(): array
    {
        return [
            'bluray',
            'remux',
            'dvdrip',
            'webdl',
            'hdtv',
            'bdscr',
            'dvdscr',
            'sdtv',
            'webrip',
            'dsr',
            'tvrip',
            'preair',
            'ppvrip',
            'hdrip',
            'r5',
            'tc',
            'ts',
            'cam',
            'workprint',
        ];
    }

    /**
     * @return array
     */
    public function getVideoCodecDefinitions(): array
    {
        return [
            '10bit',
            'h265',
            'h264',
            'xvid',
            'divx',
        ];
    }

    /**
     * @return array
     */
    public function getAudioCodecDefinitions(): array
    {
        return [
            'truehd',
            'dts',
            'dtshd',
            'flac',
            'ac3',
            'dd5.1',
            'aac',
            'mp3',
        ];
    }

    /**
     * @return array
     */
    public function getMergedTags(): array
    {
        return [
            "quality" => $this->getSourceDefinitions(),
            "resolution" => $this->getResolutionDefinitions(),
            "audio" => $this->getAudioCodecDefinitions(),
            "video" => $this->getVideoCodecDefinitions(),
        ];
    }

}
