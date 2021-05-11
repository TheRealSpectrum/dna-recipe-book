<?php

namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class Home extends Controller
{
    function home()
    {
        View::view("Home");
    }

    function test($a)
    {
        View::view("Test", [
            "testValue" => $a,
        ]);
    }
}
