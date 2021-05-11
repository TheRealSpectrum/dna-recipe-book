<?php

namespace App\Controllers;

use \App\Core\Controller;

trigger_error("Home start", E_USER_WARNING);
class Home extends Controller
{
    function home()
    {
        echo "Home";
    }

    function test($a)
    {
        echo gettype($a);
    }
}
trigger_error("Home end", E_USER_WARNING);
