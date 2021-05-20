<?php

use App\Controllers\AuthController;
use \App\Controllers\Home;
use App\Controllers\RecipeController;
use \App\Core\Route;



Route::run([
    Route::get("/", [RecipeController::class, "index"]),
    Route::get("/recipes/create", [RecipeController::class, "create"]),
    Route::post("/recipes", [RecipeController::class, "store"]),
    Route::get("/recipes/:", [RecipeController::class, "show"]),
    Route::get("/recipes/:/edit", [RecipeController::class, "edit"]),
    Route::patch("/recipes/:", [RecipeController::class, "update"]),
    Route::delete("/recipes/:", [RecipeController::class, "destroy"]),

    Route::get("/login", [AuthController::class, "login"]),
    Route::get("/logout", [AuthController::class, "logout"]),


]);
