<?php

use \App\Controllers\Home;
use App\Controllers\RecipesController;
use \App\Core\Route;

$homeController = new Home();
$recipesController = new RecipesController();

Route::list([
    Route::get("/", $homeController->parse('home')),
    Route::get("/test/:a", $homeController->parse('test')),
    Route::get("/recipes", $recipesController->parse('index')),
]);
