<?php


namespace App\Controllers;

use \App\Core\Controller;
use \App\Core\View;

class UserController extends Controller
{
    function index()
    {
        return View::view("User/Index");
    }
    function create()
    {
        return View::view("User/CreateUser");
    }
    function store()
    {
        // 
    }
    function show()
    {
        return View::view("User/ShowUser");
    }
    function edit()
    {
        return View::view("User/EditUser");
    }
    function update()
    {
        // 
    }
    function destroy()
    {
        return View::view("User/DeleteUser");
    }
}