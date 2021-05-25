<?php

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use \App\Controllers\HomeController;
use \App\Controllers\RecipeController;
use App\Controllers\UserController;
use \App\Core\Route;



Route::run([
    Route::get("/", [HomeController::class, "home"]),

    Route::resource("/recipes", RecipeController::class),

    Route::get("/login", [AuthController::class, "login"]),
    Route::get("/logout", [AuthController::class, "logout"]),

    Route::resource("/users", UserController::class),

    Route::resource("/categories", CategoryController::class),

]);
