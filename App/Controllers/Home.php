<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class Home extends Controller
{
    function home()
    {
        return View::view("Home", [], "Main");
    }

    function test($a)
    {
        return View::view("Test", [
            "testValue" => $a,
        ]);
    }
}
