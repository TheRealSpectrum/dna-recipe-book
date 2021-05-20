<?php

use App\Controllers\AuthController;
use \App\Controllers\Home;
use App\Controllers\RecipesController;
use \App\Core\Route;

$homeController = new Home();
$recipesController = new RecipesController();

Route::run([
    Route::get("/", [RecipesController::class, "index"]),
    Route::get("/recipes/create", [RecipesController::class, "create"]),
    Route::post("/recipes", [RecipesController::class, "store"]),
    Route::get("/recipes/:", [RecipesController::class, "show"]),
    Route::get("/recipes/:/edit", [RecipesController::class, "edit"]),
    Route::put("/recipes/:", [RecipesController::class, "update"]),
    Route::delete("/recipes/:", [RecipesController::class, "destroy"]),

    Route::get("/login", [AuthController::class, "login"]),
    Route::get("/logout", [AuthController::class, "logout"]),
]);
