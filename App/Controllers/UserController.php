<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

use \App\Models\User;

class UserController extends Controller
{
    function index()
    {
        return View::view("User/Index", [
            "users" => User::query("SELECT * FROM `users`"),
        ], "Main");
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
