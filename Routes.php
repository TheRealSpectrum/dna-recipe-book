<?php

use \App\Controllers\Home;
use App\Controllers\RecipesController;
use \App\Core\Route;

$homeController = new Home();
$recipesController = new RecipesController();

Route::run([
    Route::get("/", [RecipesController::class, "index"]),
    Route::get("/recipes/:", [RecipesController::class, "show"]),
]);
