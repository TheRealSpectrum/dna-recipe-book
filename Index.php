<?php

declare(strict_types=1);

function requireFiles(string $path)
{
    $files = scandir($path);
    foreach ($files as $file) {
        if (in_array($file, [".", ".."])) {
            continue;
        }

        if (is_file($path . "/" . $file)) {
            require($path . "/" . $file);
        }
        if (is_dir($path . "/" . $file)) {
            requireFiles($path . "/" . $file);
        }
    }
}

requireFiles("App");

include "Routes.php";
