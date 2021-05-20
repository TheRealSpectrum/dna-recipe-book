<?php

declare(strict_types=1);

use App\Core\DebugHandler;
use App\Core\Database;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

Database::getInstance()->connect();

include "Routes.php";

Database::getInstance()->disconnect();
