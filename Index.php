<?php

declare(strict_types=1);

use App\Core\DebugHandler;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

for ($i = 0; $i < 10; ++$i) {
    DebugHandler::getInstance()->logMessage("info", "HEY THERE");

    DebugHandler::getInstance()->logQuery("SELECT * FROM `users` WHERE `admin` IS 1", [
        [
            "id" => 0,
            "name" => "Damy",
            "admin" => 1,
        ],
        [
            "id" => 5,
            "name" => "Niels",
            "Admin" => 1,
        ],
    ]);
}


include "Routes.php";
