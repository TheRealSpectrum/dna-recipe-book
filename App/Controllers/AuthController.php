<?php 


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class AuthController extends Controller 
{
    function login() {
        return View::view("Auth/Login");
    }
    function logout() {
        return View::view("Auth/Logout");
    }
}
