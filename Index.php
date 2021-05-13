<?php

declare(strict_types=1);

use App\Core\DebugHandler;

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

DebugHandler::getInstance()->startup();

include "Routes.php";
