<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

use \App\Models\Recipe;

class HomeController extends Controller
{
    function home()
    {
        return View::view("Home", [
            "recipes" => Recipe::query("SELECT * FROM `recipes` LIMIT 6"),
        ], "Main");
    }
}
