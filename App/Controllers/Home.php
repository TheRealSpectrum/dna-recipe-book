<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class Home extends Controller
{
    function home()
    {
        return View::view("Home");
    }

    function test($a)
    {
        return View::view("Test", [
            "testValue" => $a,
        ]);
    }
    function layout()
    {
        return View::view("Layout");
    }
    function recipes()
    {
        return View::view("Recipes");
    }
}
