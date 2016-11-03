<?php

return [

    "database" => [

        "driver" => "pdo_mysql",

        "path" => __DIR__ . "/../database.sqlite",

        "dbname" => "clever",

        'user'     => "root",

        'password' => null,

    ],

    "paths" => [

        "entities" => [
            __DIR__ . "/Entity",
        ]

    ],
    
    "plugins" => [
        
        "dir" => CLEVER_ROOT_DIR . "/Plugins",
        
    ],

];
