<?php

declare(strict_types=1);

use \App\Route;

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

Route::list([
    Route::get("/a/b", function () {
        echo "ab";
    }),
    Route::get("/", function () {
        echo "index";
    }),
    Route::get("/:a/:b", function ($parameters) {
        echo $parameters["a"] . "<br>" . $parameters["b"];
    }),
]);
