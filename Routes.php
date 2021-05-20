<?php

use App\Controllers\AuthController;
use \App\Controllers\Home;
use \App\Controllers\RecipeController;
use \App\Core\Route;



Route::run([
    Route::resource("/recipes", RecipeController::class),

    Route::get("/login", [AuthController::class, "login"]),
    Route::get("/logout", [AuthController::class, "logout"]),


]);
