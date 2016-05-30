<?php

return [

    "database" => [

        "driver" => "pdo_sqlite",

        "path" => __DIR__ . "/../database.sqlite",

        'user'     => null,

        'password' => null,

    ],

    "paths" => [

        "entities" => [
            __DIR__ . "/Entity",
            __DIR__ . "/Plugins/TorrentScraper/Entity",
        ]

    ],
    
    "plugins" => [
        
        "dir" => CLEVER_ROOT_DIR . "/Plugins",
        
    ],

];
