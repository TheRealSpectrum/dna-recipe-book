<?php

use \App\Controllers\Home;
use \App\Core\Route;

$homeController = new Home();

Route::list([
    Route::get("/", $homeController->parse('home')),
    Route::get("/test/:a", $homeController->parse('test')),
    Route::get("/layout", $homeController->parse('Layout')),
]);
