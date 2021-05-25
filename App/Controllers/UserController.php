<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class UserController extends Controller
{
    function index()
    {
        return View::view("User/Index", [], "Main");
    }
    function create()
    {
        return View::view("User/CreateUser", [], "Main");
    }
    function store()
    {
        // 
    }
    function show()
    {
        return View::view("User/ShowUser", [], "Main");
    }
    function edit()
    {
        return View::view("User/EditUser", [], "Main");
    }
    function update()
    {
        // 
    }
    function destroy()
    {
        return View::view("User/DeleteUser", [], "Main");
    }
}
