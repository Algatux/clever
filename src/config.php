<?php

return [

    "database" => [

        "driver" => "sqlite",

        "database" => __DIR__ . "/../database.sqlite",

        "migrations-dir" => "/Migrations",

    ],
    
    "plugins" => [
        
        "dir" => CLEVER_ROOT_DIR . "/Plugins",
        
    ],

];
