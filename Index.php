<?php

declare(strict_types=1);

spl_autoload_register(
    function ($className) {
        include str_replace("\\", "/", $className) . ".php";
    }
);

include "Routes.php";
