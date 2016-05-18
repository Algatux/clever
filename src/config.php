<?php

return [

    "database" => [

        "driver" => "sqlite",

        "database" => __DIR__ . "/../database.sqlite",

        "migrations-dir" => "/Migrations",

    ],
    
    "plugins" => [
        
        "dir" => __DIR__ . "/Plugins",
        
    ],

];
